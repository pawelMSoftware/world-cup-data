# Data sources

This project combines five sources, each with a specific, non-overlapping role. No dataset field
is ever decided by more than one source.

## Primary source: OpenFootball

**[github.com/openfootball/worldcup.json](https://github.com/openfootball/worldcup.json)**,
`master` branch.

OpenFootball is the source of truth for everything except kickoff timestamps and attendance (the
latter is not a field OpenFootball provides at all — see [below](#match-attendance-fifa-rsssf-and-wikipedia)):

- tournament list and names
- team pairings (`team_a` / `team_b`, i.e. who played whom)
- match stage and group
- host countries
- stadium and city names
- scores (half time, full time, extra time, penalties)
- stadium geographic coordinates, where the source provides them (2026 only, via
  `2026/worldcup.stadiums.json`)

It was chosen as the primary source because it is a structured, versioned, openly-licensed dataset
covering every tournament in scope (2002–2026) in one consistent JSON shape, which is exactly what a
normalized relational rebuild needs. Its main limitation — no kickoff time at all for 2002 and 2006,
and no timezone-normalized UTC timestamp for any year — is exactly what the FIFA source below fills
in.

## Authoritative source for kickoff timestamps and team confederation: FIFA

**`api.fifa.com`** — the public API backing the official FIFA competition Match Centre
(`https://api.fifa.com/api/v3/calendar/matches`, `https://api.fifa.com/api/v3/teams/{IdTeam}`).

FIFA is authoritative for exactly two fields: `kickoff_at` and `teams.json`'s `confederation_id`.
This is a deliberate, narrower role than "primary source" — FIFA is not used for team pairings,
scores, stadiums, or stages, all of which stay sourced from OpenFootball. The two fields have a
different relationship to OpenFootball, though:

- `kickoff_at` is a genuine **override**: OpenFootball has a (sometimes present, sometimes absent)
  local time of its own, and FIFA's value wins if the two disagree.
- `confederation_id` is a pure **gap-fill**: OpenFootball has no concept of confederation at all, so
  there is nothing for FIFA to override — it is simply the only source for this field.

Why FIFA and not OpenFootball for kickoff time:

- OpenFootball has no `time` field at all for 2002 and 2006 — only a local calendar date.
- Where OpenFootball does have a time, it's a local wall-clock value (sometimes with a UTC offset
  string attached, sometimes not), which still requires conversion.
- FIFA's API returns the kickoff `Date` already normalized to UTC, verified against the official
  competition record rather than reconstructed from a timezone table.

The policy — **FIFA wins outright for `kickoff_at`, OpenFootball wins for everything else** — was
adopted after an initial audit found the two sources disagreed by exactly one hour on two 2026
fixtures (both in Mexico City). Rather than silently pick one value, FIFA's timestamp was made
authoritative project-wide, and the audit was re-run to confirm every stored `kickoff_at` now
originates from FIFA (`tests/fixtures/fifa_kickoffs.json` is a committed snapshot of that FIFA data,
used by the test suite to verify this without a live network call). See
[DATASET_AUDIT.md](DATASET_AUDIT.md) for the full history.

FIFA's match data was also used, more broadly, to *audit* every other field (teams, stadium, stage,
score) — see [DATASET_AUDIT.md](DATASET_AUDIT.md) for the full results. That audit role is read-only: it only ever
produces a report, never a silent data change.

**Confederation sourcing.** Each team's FIFA numeric `IdTeam` (found on every match record it
appears in) is stable across every tournament it appears in — verified across all 486 matches, all
72 teams resolve to exactly one `IdTeam` each, never more than one. That `IdTeam` was looked up
against `GET /api/v3/teams/{IdTeam}`, which returns `IdConfederation` directly, resolving cleanly for
all 72 teams with no gaps (including the historical `Serbia and Montenegro`, correctly resolved to
UEFA). `confederations.json`'s `name` field uses the standard English confederation name rather than
FIFA's own API text, which returns some confederation names in French or Spanish
(`Confédération Africaine de Football`, `Confederación Sudamericana de Fútbol`) — the same "use the
standard English name" policy already applied to `countries.json`'s `official_name`.

## Metadata gap-filling: Wikidata and Wikipedia

Used **only** where OpenFootball provides no value at all for a required field, and only for
geographic coordinates:

- `stadiums.json`'s `latitude` / `longitude` for the 74 stadiums used in 2002–2022 (OpenFootball
  carries no coordinate data for these tournaments at all).
- Priority order: OpenFootball's own coordinate data first (used directly for all 16 2026 stadiums,
  which do include coordinates), then Wikidata, then Wikipedia, falling back only when the higher
  priority source had no value.
- Wikidata/Wikipedia were never used for team names, scores, dates, stages, or any field OpenFootball
  or FIFA already provides — this project does not treat either as a general-purpose reference.

Wikipedia and Wikidata are otherwise **not** used elsewhere in the project — in particular, they
were excluded from the dataset audit (`docs/DATASET_AUDIT.md`) in favor of FIFA's own API. The one
other exception, `attendance`, is documented in its own section immediately below.

## Match attendance: FIFA, RSSSF, and Wikipedia

`matches[].attendance` is the one field sourced from outside OpenFootball/FIFA/Wikidata's usual
roles above. It was researched as its own milestone and is fully documented, match by match, in
[`attendance-match-mapping.md`](attendance-match-mapping.md) — that document is the canonical
source; this dataset's `attendance` values were copied from it verbatim, not re-derived.

Source priority, applied per tournament (see `attendance-match-mapping.md` for the full
per-tournament breakdown and every cross-source discrepancy found):

1. **FIFA** official match reports / live competition API — primary for 2026, cross-check
   elsewhere where available.
2. **RSSSF** (`rsssf.org`) — primary for 2002, 2010, and 2018.
3. **Wikipedia** match/group articles (citing FIFA official match reports) — primary for 2006,
   2014, 2022, and 2026; cross-check against RSSSF for 2002, 2010, and 2018.

This makes `attendance` the one field in `data/matches/` that is not sourced exclusively from
OpenFootball or FIFA — OpenFootball does not carry attendance data at all, and FIFA's API only
covers it directly for 2026.

## Referee identity: FIFA, RSSSF, and Wikipedia

`referees.json` (`name`, `association`) is sourced the same way as attendance: researched as its own
milestone and fully documented, match by match, in
[`referees-match-mapping.md`](referees-match-mapping.md) — that document is the canonical source;
`referees.json`'s values were copied from it verbatim (one row per unique referee found there), not
re-derived. OpenFootball has no referee data at all.

Source priority, applied per tournament (see `referees-match-mapping.md` for the full per-tournament
breakdown):

1. **RSSSF** (`rsssf.org`) — primary for 2002, 2006, 2010, 2014, and 2018.
2. **Wikipedia** — primary for 2022 (RSSSF has no equivalent full-table page for that tournament).
3. **FIFA** live competition API (`Officials`, `OfficialType: 1`, head referee only) — primary for
   2026.

`association` preserves FIFA's own association designation verbatim (not an ISO country code — see
[`referees-match-mapping.md`](referees-match-mapping.md) for why, e.g. the United Kingdom's four
constituent football associations).

## Summary

| Field | Source | Notes |
|---|---|---|
| Tournament list, `code`, `name`, `year` | OpenFootball | `worldcup.json`'s top-level `name` |
| Team pairings, stage, group, scores | OpenFootball | `matches[].team1/team2/round/group/score` |
| Stadium name, city | OpenFootball | `ground` field (2002–2022); dedicated `worldcup.stadiums.json` (2026) |
| Host countries | OpenFootball | derived from stadium city/country |
| Country / team identity, ISO / FIFA codes | OpenFootball + ISO 3166-1 reference | see [CONVENTIONS.md](CONVENTIONS.md) |
| Stadium coordinates (2026) | OpenFootball | `worldcup.stadiums.json` `coords` field |
| Stadium coordinates (2002–2022) | Wikidata, then Wikipedia | OpenFootball has no coordinate data for these years |
| `kickoff_at` (all years) | FIFA (`api.fifa.com`) | authoritative; OpenFootball's local time is not used |
| `teams.json`'s `confederation_id` | FIFA (`api.fifa.com`) | `GET /api/v3/teams/{IdTeam}`; OpenFootball has no confederation data |
| `matches[].attendance` | FIFA, RSSSF, Wikipedia | per-tournament priority documented above and in [`attendance-match-mapping.md`](attendance-match-mapping.md) |
| `referees.json` (`name`, `association`) | RSSSF, Wikipedia, FIFA | per-tournament priority documented above and in [`referees-match-mapping.md`](referees-match-mapping.md) |
| `matches[].referee_id` | Derived | foreign key resolving each match to its `referees.json` row; the match-to-referee assignment itself comes from [`referees-match-mapping.md`](referees-match-mapping.md), same as `referees.json` above |
| Dataset verification | FIFA (`api.fifa.com`) | read-only audit against teams/stadium/stage/score, see [DATASET_AUDIT.md](DATASET_AUDIT.md) |

## What is never used

Wikipedia and Wikidata are gap-fillers of last resort for stadium coordinates and (per the sections
above) match attendance and referee identity, not general references. FIFA is authoritative for
kickoff time and team confederation, and used for verification, but is not the primary source for
anything else besides attendance and referees. RSSSF is used for exactly two fields, attendance and
referees, and nothing else. Outside of these documented roles, no other third-party football
database, news site, or search engine result is used anywhere in this project.

**A deliberate limit on how far this goes.** Referee data was initially investigated and decided
against, for two reasons: coverage is inconsistent for the 2026 tournament if the *full* officiating
crew is wanted (most played matches expose only the head referee, not assistants/VAR), and FIFA's
`Officials` nationalities use association codes for many countries with no World Cup team in this
dataset. `referees.json` sidesteps both: it deliberately stores only the head referee
(`OfficialType: 1`), which is consistently available across every tournament, and `association` is
stored as its own free-form string rather than a `countries.json` foreign key, so it never needs
`countries.json`'s scope to grow. `data/matches/{year}.json`'s `referee_id` foreign key, resolving
each match to its `referees.json` row, was added in a later milestone once the standalone dataset
was in place.
