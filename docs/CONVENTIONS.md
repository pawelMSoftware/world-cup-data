# Conventions

This document defines the rules every dataset in `data/` follows. If a value in the data looks
inconsistent with what you'd expect, check here before assuming it's a bug.

## File format

- UTF-8 encoding, no byte order mark.
- Unix line endings (LF), including a trailing newline at end of file.
- 2-space JSON indentation.
- `snake_case` property names.
- Arrays are sorted (see [Sorting](#sorting) below) unless documented otherwise.
- Object properties always appear in the order documented for that entity in
  [DATA_MODEL.md](DATA_MODEL.md).

## Identifiers

- Every record in every dataset has an `id` field containing a [UUID version 7](https://www.rfc-editor.org/rfc/rfc9562#name-uuid-version-7)
  (`019...` — lexicographically sortable, time-ordered, no coordination required to generate).
- An `id` is permanent once assigned. It is never regenerated, even when other fields on the same
  record are corrected later (see the `2022-046` stadium fix in
  [DATASET_AUDIT.md](DATASET_AUDIT.md) for a real example: the record's `id` did not change).
- Cross-dataset references always use the UUID (`country_id`, `tournament_id`, `stadium_id`,
  `team_a_id`, `team_b_id`), never a natural key like an ISO code or a name.

## Dates and times

- All timestamps are stored in UTC, in ISO 8601 extended format with a literal `Z` suffix:
  `YYYY-MM-DDTHH:MM:SSZ`.
- No local time is ever stored, and no date/time is ever split across separate fields.
- Example: `"kickoff_at": "2022-12-18T15:00:00Z"`.
- `kickoff_at` values are sourced from official FIFA competition data, not OpenFootball — see
  [DATA_SOURCES.md](DATA_SOURCES.md) for why.

## Country codes

- `iso2` / `iso3` are [ISO 3166-1](https://en.wikipedia.org/wiki/ISO_3166-1) alpha-2 / alpha-3
  codes.
- One exception: `CS` / `SCG` (Serbia and Montenegro) is a transitionally-reserved code, kept
  deliberately because the team existed under that code at the 2006 tournament and is not the same
  entity as modern Serbia (`RS` / `SRB`). Historical entities are never merged into their modern
  successor — see [Historical entities](#historical-entities) below.
- FIFA's 3-letter team codes (`fifa_code` in `teams.json`) are a separate identifier system and are
  never treated as ISO alpha-3 codes, even where they happen to be spelled the same (e.g. `ARG`,
  `BRA`). A team's `fifa_code` and its country's `iso3` can legitimately differ — see
  [Team and country naming](#team-and-country-naming).
- `confederations.json`'s `code` (`AFC`, `CAF`, `CONCACAF`, `CONMEBOL`, `OFC`, `UEFA`) is a third,
  separate identifier system — FIFA's own confederation acronyms, not an ISO code of any kind.

## Team and country naming

`countries.json` separates two distinct name fields:

- `name` — the common English name (`Russia`, `Turkey`, `Czechia`, `Ivory Coast`, `Cape Verde`).
- `official_name` — the official English name (`Russian Federation`, `Republic of Türkiye`,
  `Czech Republic`, `Republic of Côte d'Ivoire`, `Republic of Cabo Verde`).

These frequently diverge, and the common name is not always the current ISO short name — `Cabo
Verde` is the current ISO 3166-1 short name, but `name` deliberately stores `Cape Verde`, the name
in everyday English use, matching the pattern set by the worked example in this project (`Ivory
Coast` over `Côte d'Ivoire`).

A football team is not the same concept as a sovereign country, and `teams.json` reflects that:

- England, Scotland, and Wales are three separate team records, each with its own `fifa_code`
  (`ENG`, `SCO`, `WAL`), but all three reference the single United Kingdom (`GB`) country record.
  There is no "England" or "Scotland" country, and none should ever be added.
- A team's `name` is the name actually used for the national team (`United States`, not the raw
  OpenFootball source string `USA`), which does not always match a country's `name` (compare the
  football team `Czech Republic` against the country `Czechia`).

## Historical entities

Countries and teams that no longer exist are preserved, not merged into whatever replaced them.
`Serbia and Montenegro` (2006 only) is kept as its own country and team record, distinct from
`Serbia` (2010, 2018, 2022) — it has its own ISO code, its own FIFA code (`SCG`), and its own
matches. This is deliberate: rewriting history to point old matches at a country that didn't exist
yet at the time would be less accurate, not more.

## Stadium naming policy

`stadiums.json` stores the stadium name as it was actually used at the time of the tournament, not
necessarily its current name. Sponsorship changes after a tournament do not retroactively rename the
stadium in this dataset:

| Tournament | Stored (`stadiums.json`) | Current name (not stored) |
|---|---|---|
| 2006 | `AWD-Arena` | `HDI-Arena` |
| 2006 | `AOL Arena` | `Volksparkstadion` |
| 2010 | `Soccer City` | `FNB Stadium` |

This is intentional, for two reasons:

1. A dataset of historical matches should describe the world as it was at kickoff, not as it is
   today.
2. FIFA's own competition data frequently uses a *different* current name than the one shown above
   (its own neutral, sponsor-free in-tournament branding, or a name update independent of ours) —
   see [DATASET_AUDIT.md](DATASET_AUDIT.md) for the full accounting. Chasing either "current
   commercial name" or "FIFA's current label" would mean the stored name keeps changing for reasons
   that have nothing to do with the tournament itself. Keeping the tournament-time name is the one
   stable, unambiguous choice.

`stadium.code` is a lowercase ASCII slug generated deterministically from `stadium.name` (spaces and
punctuation collapsed to single hyphens), so it moves in lockstep with the stored name.

## City naming policy

`stadiums.json` stores the city as commonly used in football coverage of the tournament (e.g.
`Miyagi`, the prefecture-level name usually used for that stadium, rather than `Rifu`, the specific
town). Where a 2026 venue is marketed under a metro-area label rather than its literal city (e.g.
`Boston (Foxborough)`, `Dallas (Arlington)`), that label is stored as-is, because it is what the
source data and public tournament branding both use. FIFA's own data sometimes uses a different
administrative level for the same physical location; this is a labeling difference, not a data
error — see [DATASET_AUDIT.md](DATASET_AUDIT.md).

## Sorting

Each dataset is sorted by a single, documented key:

| File | Sort key |
|---|---|
| `countries.json` | `iso2` ascending |
| `confederations.json` | `code` ascending |
| `teams.json` | `fifa_code` ascending |
| `stadiums.json` | `code` ascending |
| `tournaments.json` | `year` ascending |
| `tournament_hosts.json` | tournament `year` ascending, then country `name` ascending |
| `data/matches/{year}.json` | `kickoff_at` ascending within the file |
| `referees.json` | `name` ascending |

Sorting is verified by the test suite (see [tests/](../tests)), not just documented — a pull request
that breaks sort order fails `composer test`.

## Score fields

Match score fields (`half_time_*`, `full_time_*`, `extra_time_*`, `penalties_*`) are `null` when
that phase of the match did not happen or the data is not yet available (e.g. a match not yet
played). They are never computed or backfilled — a `null` half-time score is left `null` even when
the full-time score is known, because OpenFootball did not report it.

Two invariants hold across every match record:

- `extra_time_*` is only non-null if `full_time_*` is non-null.
- `penalties_*` is only non-null if `extra_time_*` is non-null.

(A penalty shootout cannot happen without extra time being played, and extra time cannot happen
without full time being recorded.)
