# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project
uses [Semantic Versioning](https://semver.org/) for its schema and dataset content.

## [Unreleased]

No changes yet.

## [1.1.0] — 2026-07-19

### Added

- `data/matches/2026.json` — `2026-103` (France v England, third-place play-off, played
  2026-07-18 at Hard Rock Stadium/"Miami Stadium") added as a new record. This match was
  previously absent from the file (not just `null`-scored) because its participants were not
  known until both semi-finals concluded. Sourced from OpenFootball (`2026/worldcup.json`, match
  `num: 103`) per the project's field-sourcing policy, and cross-checked against a freshly-fetched
  copy of FIFA's competition data (`api.fifa.com`, match `IdMatch: 400021542`) with zero
  discrepancies: `full_time_team_a`/`_b` (4/6), `half_time_team_a`/`_b` (0/4), no extra time or
  penalties (confirmed by both sources independently), and `kickoff_at` (`2026-07-18T21:00:00Z`,
  FIFA-authoritative as usual) all agree; see
  [DATASET_AUDIT.md](DATASET_AUDIT.md#2026-07-18--2026-103-added). `tests/fixtures/fifa_kickoffs.json`
  gained the corresponding `2026-103` entry. The final (`2026-104`) remains pending.

## [1.0.2] — 2026-07-15

### Changed

- `data/matches/2026.json` — `2026-102` (England v Argentina, semi-final, played 2026-07-15) gained
  its `half_time_team_a`/`_b` (0/0) and `full_time_team_a`/`_b` (1/2) scores, previously `null`
  because the match had not yet been played at v1.0.1's dataset snapshot. Verified against a
  freshly-fetched copy of FIFA's competition data with zero discrepancies; see
  [DATASET_AUDIT.md](DATASET_AUDIT.md#2026-07-15--2026-102-score-confirmed). Both semi-finals are
  now confirmed; the third-place play-off and the final remain pending.

## [1.0.1] — 2026-07-15

### Changed

- `data/matches/2026.json` — `2026-101` (France v Spain, semi-final, played 2026-07-14) gained its
  `half_time_team_a`/`_b` (0/1) and `full_time_team_a`/`_b` (0/2) scores, previously `null` because
  the match had not yet been played at v1.0.0's dataset snapshot. Verified against a freshly-fetched
  copy of FIFA's competition data with zero discrepancies; see
  [DATASET_AUDIT.md](DATASET_AUDIT.md#2026-07-15--2026-101-score-confirmed). `2026-102`, the
  third-place play-off, and the final remain pending.

## [1.0.0] — 2026-07-14

First stable release. The data model, all seven tournaments (2002–2026), and the full test suite are
considered feature-complete.

### Added

- `data/countries.json` — 70 countries, built from every team referenced across 2002–2026, with
  `name` (common English name) separated from `official_name`, ISO 3166-1 `iso2`/`iso3` codes, and
  UUID v7 identifiers. Includes `Serbia and Montenegro` as a preserved historical entity, distinct
  from `Serbia`.
- `data/confederations.json` — the 6 FIFA confederations (AFC, CAF, CONCACAF, CONMEBOL, OFC, UEFA),
  sourced from FIFA's team API; `teams.json` gained a `confederation_id` foreign key resolving all 72
  teams with no gaps (including the historical `Serbia and Montenegro`, correctly resolved to UEFA).
- `data/teams.json` — 72 national teams, normalized from OpenFootball's raw `team1`/`team2` strings
  (alias examples: `USA` → `United States`, `Côte d'Ivoire`/`Ivory Coast` → `Ivory Coast`,
  `Bosnia-Herzegovina`/`Bosnia & Herzegovina` → `Bosnia and Herzegovina`), each linked to a country
  by `country_id` and carrying its official FIFA 3-letter code.
- `data/stadiums.json` — 90 stadiums (74 from 2002–2022, 16 from the dedicated 2026
  `worldcup.stadiums.json` source), with a deterministic `code` slug, stadium-time-accurate `name`
  and `city`, and `latitude`/`longitude` in decimal degrees to 6 decimal places (sourced from
  OpenFootball where available, Wikidata/Wikipedia otherwise).
- `data/tournaments.json` — 7 tournament records (2002, 2006, 2010, 2014, 2018, 2022, 2026), `name`
  taken verbatim from each `worldcup.json`'s top-level `name`.
- `data/tournament_hosts.json` — 10 tournament/host-country join records, correctly modeling the two
  multi-host tournaments (2002: Japan, South Korea; 2026: Canada, Mexico, United States).
- `data/matches/{year}.json` — 486 match records across 7 files (one per tournament), covering team
  pairings, normalized `stage` (collapsing OpenFootball's inconsistent round labels), `group`,
  UTC `kickoff_at`, and half-time/full-time/extra-time/penalty scores.
- FIFA (`api.fifa.com`) established as the authoritative source for `kickoff_at`: every timestamp
  converted to UTC and cross-checked against FIFA's official competition data; missing OpenFootball
  kickoff times (2002 and 2006 have none) filled from FIFA. A committed FIFA snapshot
  (`tests/fixtures/fifa_kickoffs.json`) lets the test suite verify this without a live network call.
- A full dataset audit (`docs/DATASET_AUDIT.md`) comparing all 486 matches against official FIFA
  data across teams, stadium, kickoff time, stage, and score, with every warning individually
  researched and classified into 5 categories (stadium branding, historical naming, city labels,
  administrative-area labels, other/FIFA-neutral-branding).
- A Pest (PHP 8.5) test suite covering every dataset: JSON validity, required fields and field order,
  UUID v7 uniqueness and format, natural-key uniqueness, referential integrity, sort order, and
  dataset-specific business rules (e.g. penalties require extra time).
- Project documentation: `README.md`, and `docs/ARCHITECTURE.md`, `docs/DATA_MODEL.md`,
  `docs/DATA_SOURCES.md`, `docs/CONVENTIONS.md`, `docs/CONTRIBUTING.md`, `docs/CHANGELOG.md`.
- `LICENSE` (MIT).
- A GitHub Actions workflow (`.github/workflows/tests.yml`) running `composer test` on PHP 8.5 for
  every push and pull request.
- `.github/PULL_REQUEST_TEMPLATE.md` and `.github/ISSUE_TEMPLATE/` (data-correction and bug-report
  forms) matching the workflow described in `docs/CONTRIBUTING.md`.
- `.editorconfig` and `.gitattributes`, encoding the formatting rules from `docs/CONVENTIONS.md`
  (2-space JSON, 4-space PHP, LF line endings) at the editor/git level instead of by policy alone.
- `.gitignore` (excludes `vendor/` and local test-runner caches).

### Changed

- `kickoff_at` was rebuilt project-wide so that every value originates from FIFA rather than being
  derived from OpenFootball's local time, after an audit found two 2026 fixtures where the two
  sources disagreed by exactly one hour.
- `data/matches.json` (a single file) was split into `data/matches/{year}.json` (one file per
  tournament), with no change to any match's data, UUIDs, or relationships.
- Country `name`/`official_name` values were reviewed and corrected where `name` had drifted to the
  official form (`Russian Federation` → `Russia`, `Côte d'Ivoire` → `Ivory Coast`, `Cabo Verde` →
  `Cape Verde`, `Türkiye` → `Turkey`), to keep the common/official split consistent across every
  record.
- `composer.json`'s description updated to reflect the finished dataset, plus `keywords` and
  `authors` metadata added.

### Fixed

- `2022-046` (South Korea v Portugal, 2022 Group H) referenced the wrong stadium
  (`Lusail Iconic Stadium` instead of `Education City Stadium`), inherited from a single incorrect
  `ground` value in the upstream OpenFootball source. Corrected after the dataset audit identified it
  as the one confirmed data error out of 486 matches; only `stadium_id` was changed, every other
  field — including the record's `id` — was left untouched.

### Known limitations

- Two 2026 matches (the third-place play-off and the final) are not present in `data/matches/`,
  because neither OpenFootball nor FIFA had assigned real participants to them as of the dataset
  snapshot — both still carried placeholder team references. They will be added once played.
- FIFA's match calendar API does not expose a half-time score field, so `half_time_team_a`/`_b`
  values (sourced from OpenFootball) are not independently cross-verified against FIFA. This is
  documented as a stated scope limitation in `docs/DATASET_AUDIT.md`, not a gap that was silently
  skipped.

### Considered but not included

- Match officials/referees (available from FIFA's `Officials` field) were investigated in detail and
  deliberately left out of this release: coverage for the 2026 tournament is inconsistent (most
  played matches expose only the referee, not the full crew), and officials' nationalities use FIFA
  association codes for 42 countries that have never fielded a World Cup team, which would require
  broadening `countries.json`'s scope beyond "countries referenced by a team". See
  [DATA_SOURCES.md](DATA_SOURCES.md#what-is-never-used).
