# Contributing

This is a data repository, not an application — most contributions are either a correction to a
value in `data/`, an addition to the test suite, or a documentation fix. This document explains what
is expected in each case.

## Before you start

Read [ARCHITECTURE.md](ARCHITECTURE.md) and [DATA_SOURCES.md](DATA_SOURCES.md) first. Almost every
"this looks wrong" report turns out to be one of the documented, intentional conventions in
[CONVENTIONS.md](CONVENTIONS.md) — a stadium's sponsor-era name, a historical country that wasn't
merged into its successor, a `null` score for a match that hasn't been played. Check there before
opening an issue or PR.

## Data source policy

- **OpenFootball is primary** for team pairings, scores, stages, groups, stadium/city names, and
  tournament identity. Do not substitute a value from another source unless the specific policy below
  says otherwise.
- **FIFA (`api.fifa.com`) is authoritative only for `kickoff_at`.** Any change to a kickoff timestamp
  must be sourced from FIFA's competition API, not recomputed from OpenFootball's local time.
- **Wikidata/Wikipedia are gap-fillers of last resort**, used for 2002–2022 stadium coordinates
  (because OpenFootball has no coordinate data for those years) and, together with RSSSF, for
  `matches[].attendance` and `referees.json` (because OpenFootball has neither field at all — see
  [DATA_SOURCES.md](DATA_SOURCES.md#match-attendance-fifa-rsssf-and-wikipedia) and
  [DATA_SOURCES.md](DATA_SOURCES.md#referee-identity-fifa-rsssf-and-wikipedia) for the exact
  per-tournament priority of each). Do not use them to override a value OpenFootball or FIFA already
  provides.
- **No other third-party source** (news sites, other football databases, search results) is used
  anywhere in this project, beyond the RSSSF/Wikipedia attendance and referee exceptions documented
  above. A PR
  that introduces a new one will be rejected regardless of how correct the value looks — see
  [DATA_SOURCES.md](DATA_SOURCES.md) for why this boundary is kept strict.

If you believe a value is wrong, cite which of the three sources supports your correction, and check
whether it's a genuine error or one of the documented naming/branding differences in
[CONVENTIONS.md](CONVENTIONS.md) first.

## Correcting a data error

If you're not planning to open the fix yourself, report it using the "Data correction" issue
template instead — it asks for the same source and evidence required below.

1. Confirm the correct value against the appropriate source (see above).
2. Change only the field(s) that are actually wrong. Do not regenerate the record's `id` — UUIDs are
   permanent (see [CONVENTIONS.md](CONVENTIONS.md#identifiers)). The `2022-046` stadium fix (see
   [DATASET_AUDIT.md](DATASET_AUDIT.md)) is the template: one field changed, everything else on the
   record — including `id` — untouched.
3. Keep the file's existing sort order and formatting (2-space indent, UTF-8, LF, trailing newline —
   see [CONVENTIONS.md](CONVENTIONS.md#file-format)). Most editors preserve this automatically if you
   edit in place rather than regenerating the whole file.
4. Run `composer test`. A single-field correction should not require any test changes — if it does,
   stop and check whether the correction is actually right.

## Adding a new tournament

1. Add the new `worldcup.json` (and `worldcup.stadiums.json`, if OpenFootball provides one) to the
   pipeline's inputs — see [ARCHITECTURE.md](ARCHITECTURE.md#1-openfootball).
2. Add a `tournaments.json` record and, if any host countries are new, `countries.json` and
   `tournament_hosts.json` records.
3. Add any new teams/stadiums following the existing normalization rules in
   [CONVENTIONS.md](CONVENTIONS.md). A new team needs a `confederation_id` — resolve it from FIFA
   (`GET /api/v3/teams/{IdTeam}`, using the `IdTeam` found on that team's match records), the same
   way as the rest of `teams.json` — see [DATA_SOURCES.md](DATA_SOURCES.md).
4. Add `data/matches/{year}.json` following the match schema in
   [DATA_MODEL.md](DATA_MODEL.md#entities).
5. Extend `tests/Helpers.php`'s `matchYears()` to include the new year, and re-run `composer test`.

## JSON formatting

- 2-space indentation, UTF-8, LF line endings, trailing newline.
- Object keys in the order documented for that entity in [DATA_MODEL.md](DATA_MODEL.md) — this is
  enforced by the test suite (`toHaveKeys`/`array_keys` assertions), not just a style preference.
- `null`, not omission, for a field with no value. Every record in a dataset has the same key set.

## UUID rules

- Every new record gets a freshly generated UUID v7. Do not reuse or hand-write an ID.
- Never change an existing record's `id`, for any reason, including data corrections.
- Foreign keys (`country_id`, `team_a_id`, etc.) must reference an `id` that exists in the target
  file — this is checked by the test suite, and a PR that adds a dangling reference will fail CI-less
  local validation (`composer test`) immediately.

## Testing

- Every dataset has a corresponding `tests/{Entity}Test.php`. A data change that doesn't require a
  test change is the common case; a schema change (new field, new file) always requires updating the
  matching test file and, usually, `tests/Helpers.php`.
- Run the full suite before opening a PR:

  ```bash
  composer test
  ```

- All tests must pass. There is no "expected failure" or skip mechanism in this project — if a test
  is wrong, fix the test in the same PR and explain why in the PR description.
- Do not weaken an existing assertion to make a change pass. If a rule genuinely needs to change
  (for example, the group-letter range extending from A–H to A–L for 2026's 12-group format), update
  the assertion and explain the reason in the PR, in the code comment, and in
  [CHANGELOG.md](CHANGELOG.md).

## Pull request expectations

Opening a PR pre-fills a checklist from `.github/PULL_REQUEST_TEMPLATE.md` — fill it in rather than
deleting it. The same expectations, in full:

- One logical change per PR: a single data correction, a single new tournament, a single
  documentation fix. Avoid bundling unrelated corrections together — it makes the correction harder
  to verify against its source.
- State, in the PR description, which of the three sources (OpenFootball, FIFA, Wikidata/Wikipedia)
  supports the change, and quote the specific value from that source.
- Include the `composer test` output (or confirm it passes) in the PR description. CI
  (`.github/workflows/tests.yml`) runs the same command automatically on every push and pull
  request, but don't rely on it to catch a failure you didn't check locally first.
- Update [CHANGELOG.md](CHANGELOG.md) under "Unreleased" for any change to `data/`.
- If the change affects a rule documented in [CONVENTIONS.md](CONVENTIONS.md) or
  [DATA_MODEL.md](DATA_MODEL.md), update that document in the same PR — documentation and data are
  reviewed together, not as a follow-up.
