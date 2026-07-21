# World Cup disciplinary cards → match mapping (2002–2026)

Data-preparation document produced for the "World Cup Cards Match Mapping"
milestone. This is **not** part of the committed dataset — it is a working
reference to support a future decision on whether to add match-level
disciplinary statistics to `world-cup-data`.

> This document is the canonical source for match disciplinary statistics.
>
> Future machine-readable datasets should be generated from this document
> rather than edited manually.

## Method

- **Team A** = `team_a` and **Team B** = `team_b` in this repo's match
  records, matching the repository's own match schema. World Cup matches
  are played at neutral venues except for the host nation, so this
  labeling carries no home-advantage implication.
- **Counting convention**: a second-yellow-card dismissal counts as *both* a
  yellow card and a red card for that player — this is the standard
  convention used by RSSSF, Wikipedia, and most football statistics
  sources, and was applied consistently across all 488 matches.
- **Included**: cards shown during regular time and extra time.
- **Excluded**: penalty-shootout misconduct, cards shown after the final
  whistle, and administrative/off-field sanctions (e.g. a suspended
  manager not on the bench). Where a specific card's timing was ambiguous
  (e.g. the 2022 Netherlands v Argentina quarter-final, where a red card
  was confirmed to have occurred *during* the shootout), the exclusion rule
  was applied and is documented in "Normalization notes" below.
- **VAR**: for tournaments using VAR (2018 onward), the final/confirmed
  card outcome after review was used, not any initial on-field decision
  that was later overturned.

Sources used, by tournament:

- **2002, 2006, 2010, 2014** — RSSSF's per-tournament full match pages
  (`rsssf.org/tables/{year}full.html`), which list every card per player
  with minute and type. Parsed directly against each match's booked/
  sent-off notation.
- **2018, 2022** — Wikipedia's per-group and per-knockout-round match
  articles (which themselves cite official FIFA match reports), used as
  the primary source; cross-checked against a second source (ESPN box
  scores, named-player lists, or ESPN/FIFA search results) wherever the
  primary source was internally inconsistent or contradicted by another
  account.
- **2026** — FIFA's own live match-timeline API (`api.fifa.com`), the same
  class of authoritative primary source already used elsewhere in this
  project for `kickoff_at` and referee assignments. Covers all 104 matches
  now committed in `data/matches/2026.json`, including the third-place match
  (`2026-103`) and the final (`2026-104`), both added once played.

Every row was cross-checked against this repo's actual match records
(`data/matches/*.json`: team pairing, UTC kickoff time, tournament) rather
than assumed from source-side ordering. Where sources disagreed, the
discrepancy is documented explicitly in "Normalization notes" rather than
silently resolved.

## Match → cards mapping (488 rows)

| Match | Tournament | Team A Yellow Cards | Team B Yellow Cards | Team A Red Cards | Team B Red Cards |
|---|---|---|---|---|---|
| 2002-001 | 2002 | 1 | 1 | 0 | 0 |
| 2002-002 | 2002 | 3 | 1 | 0 | 0 |
| 2002-003 | 2002 | 1 | 2 | 0 | 0 |
| 2002-004 | 2002 | 2 | 1 | 0 | 0 |
| 2002-005 | 2002 | 1 | 2 | 0 | 0 |
| 2002-006 | 2002 | 4 | 4 | 0 | 0 |
| 2002-007 | 2002 | 2 | 1 | 0 | 0 |
| 2002-008 | 2002 | 1 | 2 | 0 | 0 |
| 2002-009 | 2002 | 0 | 0 | 1 | 0 |
| 2002-010 | 2002 | 1 | 5 | 0 | 2 |
| 2002-011 | 2002 | 0 | 3 | 0 | 0 |
| 2002-012 | 2002 | 3 | 4 | 0 | 0 |
| 2002-013 | 2002 | 2 | 3 | 0 | 0 |
| 2002-014 | 2002 | 2 | 3 | 0 | 0 |
| 2002-015 | 2002 | 2 | 2 | 0 | 0 |
| 2002-016 | 2002 | 1 | 2 | 0 | 0 |
| 2002-017 | 2002 | 0 | 0 | 0 | 0 |
| 2002-018 | 2002 | 1 | 4 | 1 | 0 |
| 2002-019 | 2002 | 1 | 1 | 0 | 0 |
| 2002-020 | 2002 | 4 | 3 | 0 | 1 |
| 2002-021 | 2002 | 2 | 1 | 0 | 0 |
| 2002-022 | 2002 | 1 | 3 | 0 | 0 |
| 2002-023 | 2002 | 1 | 2 | 0 | 0 |
| 2002-024 | 2002 | 2 | 4 | 0 | 0 |
| 2002-025 | 2002 | 1 | 1 | 0 | 0 |
| 2002-026 | 2002 | 2 | 0 | 0 | 0 |
| 2002-027 | 2002 | 1 | 5 | 0 | 0 |
| 2002-028 | 2002 | 2 | 3 | 0 | 0 |
| 2002-029 | 2002 | 3 | 3 | 0 | 0 |
| 2002-030 | 2002 | 1 | 2 | 0 | 0 |
| 2002-031 | 2002 | 4 | 1 | 0 | 0 |
| 2002-032 | 2002 | 3 | 2 | 0 | 0 |
| 2002-033 | 2002 | 2 | 1 | 0 | 0 |
| 2002-034 | 2002 | 7 | 5 | 0 | 0 |
| 2002-035 | 2002 | 8 | 8 | 1 | 1 |
| 2002-036 | 2002 | 1 | 1 | 0 | 0 |
| 2002-037 | 2002 | 2 | 3 | 0 | 0 |
| 2002-038 | 2002 | 0 | 0 | 0 | 0 |
| 2002-039 | 2002 | 4 | 0 | 0 | 0 |
| 2002-040 | 2002 | 4 | 1 | 1 | 1 |
| 2002-041 | 2002 | 0 | 1 | 0 | 0 |
| 2002-042 | 2002 | 3 | 2 | 0 | 1 |
| 2002-043 | 2002 | 2 | 5 | 0 | 0 |
| 2002-044 | 2002 | 1 | 2 | 0 | 0 |
| 2002-045 | 2002 | 2 | 0 | 0 | 0 |
| 2002-046 | 2002 | 1 | 4 | 0 | 0 |
| 2002-047 | 2002 | 3 | 4 | 2 | 0 |
| 2002-048 | 2002 | 4 | 1 | 0 | 0 |
| 2002-049 | 2002 | 3 | 2 | 0 | 1 |
| 2002-050 | 2002 | 1 | 1 | 0 | 0 |
| 2002-051 | 2002 | 0 | 2 | 0 | 0 |
| 2002-052 | 2002 | 3 | 0 | 0 | 0 |
| 2002-053 | 2002 | 5 | 5 | 1 | 0 |
| 2002-054 | 2002 | 1 | 1 | 0 | 0 |
| 2002-055 | 2002 | 1 | 3 | 0 | 0 |
| 2002-056 | 2002 | 4 | 5 | 0 | 1 |
| 2002-057 | 2002 | 2 | 0 | 0 | 1 |
| 2002-058 | 2002 | 2 | 5 | 0 | 0 |
| 2002-059 | 2002 | 2 | 1 | 0 | 0 |
| 2002-060 | 2002 | 2 | 2 | 0 | 0 |
| 2002-061 | 2002 | 2 | 1 | 0 | 0 |
| 2002-062 | 2002 | 1 | 2 | 0 | 0 |
| 2002-063 | 2002 | 1 | 2 | 0 | 0 |
| 2002-064 | 2002 | 1 | 1 | 0 | 0 |
| 2006-001 | 2006 | 0 | 1 | 0 | 0 |
| 2006-002 | 2006 | 1 | 2 | 0 | 0 |
| 2006-003 | 2006 | 2 | 1 | 0 | 0 |
| 2006-004 | 2006 | 2 | 1 | 1 | 0 |
| 2006-005 | 2006 | 3 | 2 | 0 | 0 |
| 2006-006 | 2006 | 4 | 2 | 0 | 0 |
| 2006-007 | 2006 | 1 | 1 | 0 | 0 |
| 2006-008 | 2006 | 3 | 2 | 0 | 0 |
| 2006-009 | 2006 | 3 | 2 | 0 | 0 |
| 2006-010 | 2006 | 2 | 4 | 0 | 0 |
| 2006-011 | 2006 | 1 | 3 | 0 | 0 |
| 2006-012 | 2006 | 4 | 3 | 0 | 0 |
| 2006-013 | 2006 | 3 | 5 | 0 | 0 |
| 2006-014 | 2006 | 2 | 4 | 0 | 2 |
| 2006-015 | 2006 | 0 | 2 | 0 | 1 |
| 2006-016 | 2006 | 4 | 0 | 0 | 0 |
| 2006-017 | 2006 | 3 | 4 | 0 | 1 |
| 2006-018 | 2006 | 3 | 2 | 0 | 0 |
| 2006-019 | 2006 | 1 | 5 | 0 | 0 |
| 2006-020 | 2006 | 3 | 5 | 0 | 0 |
| 2006-021 | 2006 | 1 | 3 | 0 | 1 |
| 2006-022 | 2006 | 4 | 3 | 0 | 0 |
| 2006-023 | 2006 | 1 | 5 | 0 | 1 |
| 2006-024 | 2006 | 3 | 4 | 0 | 0 |
| 2006-025 | 2006 | 2 | 2 | 1 | 2 |
| 2006-026 | 2006 | 1 | 6 | 1 | 0 |
| 2006-027 | 2006 | 3 | 2 | 0 | 0 |
| 2006-028 | 2006 | 3 | 2 | 0 | 0 |
| 2006-029 | 2006 | 2 | 2 | 0 | 0 |
| 2006-030 | 2006 | 3 | 1 | 0 | 0 |
| 2006-031 | 2006 | 2 | 6 | 0 | 0 |
| 2006-032 | 2006 | 3 | 3 | 0 | 0 |
| 2006-033 | 2006 | 1 | 1 | 0 | 0 |
| 2006-034 | 2006 | 5 | 5 | 0 | 0 |
| 2006-035 | 2006 | 2 | 1 | 0 | 0 |
| 2006-036 | 2006 | 2 | 2 | 0 | 0 |
| 2006-037 | 2006 | 3 | 2 | 0 | 0 |
| 2006-038 | 2006 | 4 | 5 | 1 | 1 |
| 2006-039 | 2006 | 4 | 5 | 0 | 1 |
| 2006-040 | 2006 | 3 | 3 | 0 | 0 |
| 2006-041 | 2006 | 2 | 1 | 1 | 0 |
| 2006-042 | 2006 | 4 | 1 | 0 | 0 |
| 2006-043 | 2006 | 1 | 1 | 0 | 0 |
| 2006-044 | 2006 | 8 | 2 | 2 | 1 |
| 2006-045 | 2006 | 3 | 1 | 0 | 0 |
| 2006-046 | 2006 | 5 | 3 | 0 | 0 |
| 2006-047 | 2006 | 2 | 3 | 0 | 0 |
| 2006-048 | 2006 | 4 | 4 | 0 | 1 |
| 2006-049 | 2006 | 1 | 4 | 0 | 1 |
| 2006-050 | 2006 | 2 | 4 | 0 | 0 |
| 2006-051 | 2006 | 3 | 3 | 0 | 0 |
| 2006-052 | 2006 | 9 | 7 | 2 | 2 |
| 2006-053 | 2006 | 3 | 3 | 1 | 0 |
| 2006-054 | 2006 | 1 | 0 | 0 | 0 |
| 2006-055 | 2006 | 2 | 6 | 0 | 1 |
| 2006-056 | 2006 | 1 | 3 | 0 | 0 |
| 2006-057 | 2006 | 3 | 4 | 0 | 0 |
| 2006-058 | 2006 | 0 | 3 | 0 | 0 |
| 2006-059 | 2006 | 2 | 2 | 1 | 0 |
| 2006-060 | 2006 | 4 | 3 | 0 | 0 |
| 2006-061 | 2006 | 2 | 1 | 0 | 0 |
| 2006-062 | 2006 | 1 | 1 | 0 | 0 |
| 2006-063 | 2006 | 2 | 3 | 0 | 0 |
| 2006-064 | 2006 | 1 | 3 | 0 | 1 |
| 2010-001 | 2010 | 2 | 2 | 0 | 0 |
| 2010-002 | 2010 | 4 | 3 | 1 | 0 |
| 2010-003 | 2010 | 1 | 1 | 0 | 0 |
| 2010-004 | 2010 | 0 | 1 | 0 | 0 |
| 2010-005 | 2010 | 3 | 3 | 0 | 0 |
| 2010-006 | 2010 | 3 | 2 | 1 | 0 |
| 2010-007 | 2010 | 2 | 3 | 0 | 1 |
| 2010-008 | 2010 | 4 | 2 | 1 | 0 |
| 2010-009 | 2010 | 2 | 1 | 0 | 0 |
| 2010-010 | 2010 | 1 | 1 | 0 | 0 |
| 2010-011 | 2010 | 1 | 1 | 0 | 0 |
| 2010-012 | 2010 | 2 | 1 | 0 | 0 |
| 2010-013 | 2010 | 2 | 1 | 0 | 0 |
| 2010-014 | 2010 | 1 | 0 | 0 | 0 |
| 2010-015 | 2010 | 1 | 2 | 0 | 0 |
| 2010-016 | 2010 | 0 | 4 | 0 | 0 |
| 2010-017 | 2010 | 2 | 0 | 1 | 0 |
| 2010-018 | 2010 | 2 | 4 | 0 | 0 |
| 2010-019 | 2010 | 3 | 1 | 0 | 1 |
| 2010-020 | 2010 | 3 | 2 | 0 | 0 |
| 2010-021 | 2010 | 5 | 4 | 1 | 0 |
| 2010-022 | 2010 | 4 | 1 | 0 | 0 |
| 2010-023 | 2010 | 1 | 1 | 0 | 0 |
| 2010-024 | 2010 | 3 | 1 | 0 | 1 |
| 2010-025 | 2010 | 1 | 0 | 0 | 0 |
| 2010-026 | 2010 | 2 | 2 | 0 | 0 |
| 2010-027 | 2010 | 3 | 1 | 0 | 0 |
| 2010-028 | 2010 | 0 | 3 | 0 | 0 |
| 2010-029 | 2010 | 2 | 3 | 1 | 0 |
| 2010-030 | 2010 | 2 | 2 | 0 | 0 |
| 2010-031 | 2010 | 6 | 3 | 0 | 1 |
| 2010-032 | 2010 | 0 | 2 | 0 | 0 |
| 2010-033 | 2010 | 2 | 1 | 0 | 0 |
| 2010-034 | 2010 | 1 | 0 | 1 | 0 |
| 2010-035 | 2010 | 3 | 1 | 0 | 0 |
| 2010-036 | 2010 | 1 | 1 | 0 | 0 |
| 2010-037 | 2010 | 3 | 1 | 0 | 0 |
| 2010-038 | 2010 | 2 | 4 | 0 | 1 |
| 2010-039 | 2010 | 1 | 1 | 0 | 0 |
| 2010-040 | 2010 | 3 | 2 | 0 | 0 |
| 2010-041 | 2010 | 4 | 4 | 0 | 0 |
| 2010-042 | 2010 | 2 | 1 | 0 | 0 |
| 2010-043 | 2010 | 3 | 2 | 0 | 0 |
| 2010-044 | 2010 | 2 | 3 | 0 | 0 |
| 2010-045 | 2010 | 3 | 4 | 0 | 0 |
| 2010-046 | 2010 | 0 | 0 | 0 | 0 |
| 2010-047 | 2010 | 4 | 0 | 1 | 0 |
| 2010-048 | 2010 | 1 | 4 | 0 | 0 |
| 2010-049 | 2010 | 0 | 3 | 0 | 0 |
| 2010-050 | 2010 | 3 | 2 | 0 | 0 |
| 2010-051 | 2010 | 1 | 1 | 0 | 0 |
| 2010-052 | 2010 | 0 | 1 | 0 | 0 |
| 2010-053 | 2010 | 2 | 3 | 0 | 0 |
| 2010-054 | 2010 | 2 | 3 | 0 | 0 |
| 2010-055 | 2010 | 1 | 4 | 0 | 0 |
| 2010-056 | 2010 | 1 | 1 | 0 | 1 |
| 2010-057 | 2010 | 4 | 1 | 0 | 1 |
| 2010-058 | 2010 | 3 | 3 | 1 | 0 |
| 2010-059 | 2010 | 2 | 1 | 0 | 0 |
| 2010-060 | 2010 | 4 | 2 | 0 | 0 |
| 2010-061 | 2010 | 2 | 3 | 0 | 0 |
| 2010-062 | 2010 | 0 | 0 | 0 | 0 |
| 2010-063 | 2010 | 1 | 3 | 0 | 0 |
| 2010-064 | 2010 | 9 | 5 | 1 | 0 |
| 2014-001 | 2014 | 2 | 2 | 0 | 0 |
| 2014-002 | 2014 | 1 | 1 | 0 | 0 |
| 2014-003 | 2014 | 1 | 3 | 0 | 0 |
| 2014-004 | 2014 | 1 | 3 | 0 | 0 |
| 2014-005 | 2014 | 1 | 2 | 0 | 0 |
| 2014-006 | 2014 | 2 | 2 | 0 | 0 |
| 2014-007 | 2014 | 3 | 0 | 1 | 0 |
| 2014-008 | 2014 | 1 | 0 | 0 | 0 |
| 2014-009 | 2014 | 1 | 1 | 0 | 0 |
| 2014-010 | 2014 | 3 | 4 | 0 | 1 |
| 2014-011 | 2014 | 1 | 1 | 0 | 0 |
| 2014-012 | 2014 | 1 | 0 | 0 | 0 |
| 2014-013 | 2014 | 0 | 1 | 0 | 1 |
| 2014-014 | 2014 | 2 | 0 | 0 | 0 |
| 2014-015 | 2014 | 1 | 1 | 0 | 0 |
| 2014-016 | 2014 | 1 | 3 | 0 | 0 |
| 2014-017 | 2014 | 2 | 2 | 0 | 0 |
| 2014-018 | 2014 | 0 | 1 | 1 | 0 |
| 2014-019 | 2014 | 1 | 2 | 0 | 0 |
| 2014-020 | 2014 | 1 | 1 | 0 | 0 |
| 2014-021 | 2014 | 0 | 2 | 0 | 0 |
| 2014-022 | 2014 | 1 | 4 | 0 | 1 |
| 2014-023 | 2014 | 1 | 1 | 0 | 0 |
| 2014-024 | 2014 | 1 | 1 | 0 | 0 |
| 2014-025 | 2014 | 0 | 1 | 0 | 0 |
| 2014-026 | 2014 | 2 | 3 | 0 | 0 |
| 2014-027 | 2014 | 0 | 2 | 0 | 0 |
| 2014-028 | 2014 | 1 | 1 | 0 | 0 |
| 2014-029 | 2014 | 0 | 1 | 0 | 0 |
| 2014-030 | 2014 | 1 | 0 | 0 | 0 |
| 2014-031 | 2014 | 2 | 1 | 0 | 0 |
| 2014-032 | 2014 | 2 | 1 | 0 | 0 |
| 2014-033 | 2014 | 3 | 0 | 0 | 0 |
| 2014-034 | 2014 | 1 | 2 | 1 | 0 |
| 2014-035 | 2014 | 2 | 1 | 0 | 0 |
| 2014-036 | 2014 | 1 | 1 | 0 | 0 |
| 2014-037 | 2014 | 1 | 1 | 0 | 0 |
| 2014-038 | 2014 | 0 | 3 | 0 | 0 |
| 2014-039 | 2014 | 2 | 2 | 1 | 0 |
| 2014-040 | 2014 | 1 | 2 | 0 | 0 |
| 2014-041 | 2014 | 1 | 0 | 0 | 0 |
| 2014-042 | 2014 | 1 | 0 | 1 | 0 |
| 2014-043 | 2014 | 2 | 0 | 0 | 0 |
| 2014-044 | 2014 | 1 | 1 | 0 | 0 |
| 2014-045 | 2014 | 2 | 1 | 0 | 0 |
| 2014-046 | 2014 | 1 | 3 | 0 | 0 |
| 2014-047 | 2014 | 1 | 1 | 0 | 1 |
| 2014-048 | 2014 | 2 | 2 | 0 | 0 |
| 2014-049 | 2014 | 4 | 3 | 0 | 0 |
| 2014-050 | 2014 | 1 | 1 | 0 | 0 |
| 2014-051 | 2014 | 0 | 3 | 0 | 0 |
| 2014-052 | 2014 | 5 | 2 | 1 | 0 |
| 2014-053 | 2014 | 1 | 0 | 0 | 0 |
| 2014-054 | 2014 | 1 | 1 | 0 | 0 |
| 2014-055 | 2014 | 3 | 2 | 0 | 0 |
| 2014-056 | 2014 | 1 | 1 | 0 | 0 |
| 2014-057 | 2014 | 2 | 2 | 0 | 0 |
| 2014-058 | 2014 | 0 | 2 | 0 | 0 |
| 2014-059 | 2014 | 2 | 4 | 0 | 0 |
| 2014-060 | 2014 | 1 | 2 | 0 | 0 |
| 2014-061 | 2014 | 1 | 0 | 0 | 0 |
| 2014-062 | 2014 | 2 | 1 | 0 | 0 |
| 2014-063 | 2014 | 3 | 2 | 0 | 0 |
| 2014-064 | 2014 | 2 | 2 | 0 | 0 |
| 2018-001 | 2018 | 1 | 1 | 0 | 0 |
| 2018-002 | 2018 | 2 | 0 | 0 | 0 |
| 2018-003 | 2018 | 1 | 1 | 0 | 0 |
| 2018-004 | 2018 | 1 | 3 | 0 | 0 |
| 2018-005 | 2018 | 1 | 3 | 0 | 0 |
| 2018-006 | 2018 | 1 | 3 | 0 | 0 |
| 2018-007 | 2018 | 0 | 0 | 0 | 0 |
| 2018-008 | 2018 | 2 | 1 | 0 | 0 |
| 2018-009 | 2018 | 1 | 3 | 0 | 0 |
| 2018-010 | 2018 | 2 | 0 | 0 | 0 |
| 2018-011 | 2018 | 2 | 3 | 0 | 0 |
| 2018-012 | 2018 | 1 | 3 | 0 | 0 |
| 2018-013 | 2018 | 3 | 5 | 0 | 0 |
| 2018-014 | 2018 | 0 | 1 | 0 | 0 |
| 2018-015 | 2018 | 1 | 3 | 0 | 0 |
| 2018-016 | 2018 | 0 | 1 | 1 | 0 |
| 2018-017 | 2018 | 1 | 1 | 0 | 0 |
| 2018-018 | 2018 | 0 | 0 | 0 | 0 |
| 2018-019 | 2018 | 0 | 1 | 0 | 0 |
| 2018-020 | 2018 | 3 | 0 | 0 | 0 |
| 2018-021 | 2018 | 2 | 3 | 0 | 0 |
| 2018-022 | 2018 | 2 | 0 | 0 | 0 |
| 2018-023 | 2018 | 3 | 4 | 0 | 0 |
| 2018-024 | 2018 | 1 | 0 | 0 | 0 |
| 2018-025 | 2018 | 2 | 1 | 0 | 0 |
| 2018-026 | 2018 | 5 | 1 | 0 | 0 |
| 2018-027 | 2018 | 2 | 2 | 1 | 0 |
| 2018-028 | 2018 | 4 | 0 | 0 | 0 |
| 2018-029 | 2018 | 0 | 1 | 0 | 0 |
| 2018-030 | 2018 | 1 | 3 | 0 | 0 |
| 2018-031 | 2018 | 2 | 0 | 0 | 0 |
| 2018-032 | 2018 | 2 | 3 | 0 | 0 |
| 2018-033 | 2018 | 1 | 3 | 0 | 1 |
| 2018-034 | 2018 | 0 | 2 | 0 | 0 |
| 2018-035 | 2018 | 2 | 5 | 0 | 0 |
| 2018-036 | 2018 | 0 | 6 | 0 | 0 |
| 2018-037 | 2018 | 1 | 0 | 0 | 0 |
| 2018-038 | 2018 | 4 | 3 | 0 | 0 |
| 2018-039 | 2018 | 2 | 3 | 0 | 0 |
| 2018-040 | 2018 | 3 | 3 | 0 | 0 |
| 2018-041 | 2018 | 3 | 0 | 0 | 0 |
| 2018-042 | 2018 | 4 | 5 | 0 | 0 |
| 2018-043 | 2018 | 5 | 0 | 0 | 0 |
| 2018-044 | 2018 | 1 | 0 | 0 | 0 |
| 2018-045 | 2018 | 0 | 2 | 0 | 0 |
| 2018-046 | 2018 | 1 | 4 | 0 | 0 |
| 2018-047 | 2018 | 1 | 0 | 0 | 0 |
| 2018-048 | 2018 | 2 | 0 | 0 | 0 |
| 2018-049 | 2018 | 3 | 5 | 0 | 0 |
| 2018-050 | 2018 | 0 | 1 | 0 | 0 |
| 2018-051 | 2018 | 1 | 2 | 0 | 0 |
| 2018-052 | 2018 | 0 | 1 | 0 | 0 |
| 2018-053 | 2018 | 2 | 4 | 0 | 0 |
| 2018-054 | 2018 | 0 | 1 | 0 | 0 |
| 2018-055 | 2018 | 1 | 2 | 0 | 1 |
| 2018-056 | 2018 | 6 | 2 | 0 | 0 |
| 2018-057 | 2018 | 2 | 2 | 0 | 0 |
| 2018-058 | 2018 | 2 | 2 | 0 | 0 |
| 2018-059 | 2018 | 1 | 4 | 0 | 0 |
| 2018-060 | 2018 | 2 | 1 | 0 | 0 |
| 2018-061 | 2018 | 2 | 3 | 0 | 0 |
| 2018-062 | 2018 | 2 | 1 | 0 | 0 |
| 2018-063 | 2018 | 1 | 2 | 0 | 0 |
| 2018-064 | 2018 | 2 | 1 | 0 | 0 |
| 2022-001 | 2022 | 4 | 2 | 0 | 0 |
| 2022-002 | 2022 | 2 | 1 | 0 | 0 |
| 2022-003 | 2022 | 0 | 2 | 0 | 0 |
| 2022-004 | 2022 | 4 | 1 | 0 | 0 |
| 2022-005 | 2022 | 0 | 3 | 0 | 0 |
| 2022-006 | 2022 | 1 | 1 | 0 | 0 |
| 2022-007 | 2022 | 2 | 1 | 0 | 0 |
| 2022-008 | 2022 | 0 | 6 | 0 | 0 |
| 2022-009 | 2022 | 3 | 3 | 0 | 0 |
| 2022-010 | 2022 | 0 | 2 | 0 | 0 |
| 2022-011 | 2022 | 0 | 0 | 0 | 0 |
| 2022-012 | 2022 | 1 | 0 | 0 | 0 |
| 2022-013 | 2022 | 2 | 1 | 0 | 0 |
| 2022-014 | 2022 | 1 | 0 | 0 | 0 |
| 2022-015 | 2022 | 2 | 5 | 0 | 0 |
| 2022-016 | 2022 | 0 | 3 | 0 | 0 |
| 2022-017 | 2022 | 1 | 2 | 0 | 0 |
| 2022-018 | 2022 | 3 | 3 | 0 | 0 |
| 2022-019 | 2022 | 0 | 1 | 0 | 0 |
| 2022-020 | 2022 | 0 | 0 | 0 | 0 |
| 2022-021 | 2022 | 3 | 0 | 0 | 0 |
| 2022-022 | 2022 | 3 | 3 | 0 | 0 |
| 2022-023 | 2022 | 1 | 2 | 0 | 0 |
| 2022-024 | 2022 | 1 | 3 | 0 | 0 |
| 2022-025 | 2022 | 3 | 2 | 0 | 0 |
| 2022-026 | 2022 | 1 | 1 | 0 | 0 |
| 2022-027 | 2022 | 2 | 3 | 0 | 0 |
| 2022-028 | 2022 | 1 | 3 | 0 | 0 |
| 2022-029 | 2022 | 1 | 1 | 0 | 0 |
| 2022-030 | 2022 | 1 | 1 | 0 | 0 |
| 2022-031 | 2022 | 1 | 1 | 0 | 0 |
| 2022-032 | 2022 | 3 | 3 | 0 | 0 |
| 2022-033 | 2022 | 2 | 0 | 0 | 0 |
| 2022-034 | 2022 | 3 | 0 | 1 | 0 |
| 2022-035 | 2022 | 0 | 1 | 0 | 0 |
| 2022-036 | 2022 | 1 | 0 | 0 | 0 |
| 2022-037 | 2022 | 2 | 1 | 0 | 0 |
| 2022-038 | 2022 | 1 | 0 | 0 | 0 |
| 2022-039 | 2022 | 1 | 1 | 0 | 0 |
| 2022-040 | 2022 | 6 | 0 | 0 | 0 |
| 2022-041 | 2022 | 2 | 1 | 0 | 0 |
| 2022-042 | 2022 | 5 | 1 | 0 | 0 |
| 2022-043 | 2022 | 3 | 0 | 0 | 0 |
| 2022-044 | 2022 | 1 | 0 | 0 | 0 |
| 2022-045 | 2022 | 2 | 4 | 0 | 0 |
| 2022-046 | 2022 | 1 | 0 | 0 | 0 |
| 2022-047 | 2022 | 7 | 4 | 0 | 0 |
| 2022-048 | 2022 | 3 | 1 | 0 | 0 |
| 2022-049 | 2022 | 1 | 0 | 0 | 0 |
| 2022-050 | 2022 | 0 | 2 | 0 | 0 |
| 2022-051 | 2022 | 0 | 1 | 0 | 0 |
| 2022-052 | 2022 | 1 | 2 | 0 | 0 |
| 2022-053 | 2022 | 0 | 2 | 0 | 0 |
| 2022-054 | 2022 | 0 | 1 | 0 | 0 |
| 2022-055 | 2022 | 1 | 1 | 0 | 0 |
| 2022-056 | 2022 | 0 | 2 | 0 | 0 |
| 2022-057 | 2022 | 8 | 8 | 0 | 0 |
| 2022-058 | 2022 | 2 | 3 | 0 | 0 |
| 2022-059 | 2022 | 1 | 3 | 0 | 0 |
| 2022-060 | 2022 | 2 | 1 | 1 | 0 |
| 2022-061 | 2022 | 2 | 2 | 0 | 0 |
| 2022-062 | 2022 | 1 | 0 | 0 | 0 |
| 2022-063 | 2022 | 0 | 2 | 0 | 0 |
| 2022-064 | 2022 | 4 | 3 | 0 | 0 |
| 2026-001 | 2026 | 1 | 2 | 1 | 2 |
| 2026-002 | 2026 | 1 | 0 | 0 | 0 |
| 2026-003 | 2026 | 2 | 3 | 0 | 0 |
| 2026-004 | 2026 | 1 | 5 | 0 | 0 |
| 2026-005 | 2026 | 1 | 3 | 0 | 0 |
| 2026-006 | 2026 | 3 | 1 | 0 | 0 |
| 2026-007 | 2026 | 2 | 2 | 0 | 0 |
| 2026-008 | 2026 | 1 | 1 | 0 | 0 |
| 2026-009 | 2026 | 2 | 1 | 0 | 0 |
| 2026-010 | 2026 | 1 | 0 | 0 | 0 |
| 2026-011 | 2026 | 2 | 1 | 0 | 0 |
| 2026-012 | 2026 | 2 | 3 | 0 | 0 |
| 2026-013 | 2026 | 2 | 1 | 0 | 0 |
| 2026-014 | 2026 | 1 | 0 | 0 | 0 |
| 2026-015 | 2026 | 3 | 2 | 0 | 0 |
| 2026-016 | 2026 | 1 | 2 | 0 | 0 |
| 2026-017 | 2026 | 1 | 3 | 0 | 0 |
| 2026-018 | 2026 | 2 | 1 | 0 | 0 |
| 2026-019 | 2026 | 1 | 3 | 0 | 0 |
| 2026-020 | 2026 | 2 | 2 | 0 | 0 |
| 2026-021 | 2026 | 2 | 1 | 0 | 0 |
| 2026-022 | 2026 | 1 | 2 | 0 | 0 |
| 2026-023 | 2026 | 1 | 3 | 0 | 0 |
| 2026-024 | 2026 | 2 | 1 | 0 | 0 |
| 2026-025 | 2026 | 2 | 2 | 0 | 0 |
| 2026-026 | 2026 | 1 | 2 | 0 | 0 |
| 2026-027 | 2026 | 1 | 1 | 0 | 0 |
| 2026-028 | 2026 | 2 | 1 | 0 | 0 |
| 2026-029 | 2026 | 1 | 3 | 0 | 0 |
| 2026-030 | 2026 | 3 | 2 | 0 | 0 |
| 2026-031 | 2026 | 2 | 1 | 0 | 0 |
| 2026-032 | 2026 | 1 | 1 | 0 | 0 |
| 2026-033 | 2026 | 2 | 2 | 0 | 0 |
| 2026-034 | 2026 | 1 | 3 | 0 | 0 |
| 2026-035 | 2026 | 2 | 1 | 0 | 0 |
| 2026-036 | 2026 | 1 | 2 | 0 | 0 |
| 2026-037 | 2026 | 1 | 1 | 0 | 0 |
| 2026-038 | 2026 | 1 | 2 | 0 | 0 |
| 2026-039 | 2026 | 2 | 1 | 0 | 0 |
| 2026-040 | 2026 | 2 | 3 | 0 | 0 |
| 2026-041 | 2026 | 1 | 2 | 0 | 0 |
| 2026-042 | 2026 | 3 | 1 | 0 | 0 |
| 2026-043 | 2026 | 1 | 2 | 0 | 0 |
| 2026-044 | 2026 | 2 | 1 | 0 | 0 |
| 2026-045 | 2026 | 2 | 2 | 0 | 0 |
| 2026-046 | 2026 | 1 | 3 | 0 | 0 |
| 2026-047 | 2026 | 1 | 1 | 0 | 0 |
| 2026-048 | 2026 | 2 | 2 | 0 | 0 |
| 2026-049 | 2026 | 1 | 1 | 0 | 0 |
| 2026-050 | 2026 | 2 | 2 | 0 | 0 |
| 2026-051 | 2026 | 1 | 2 | 0 | 0 |
| 2026-052 | 2026 | 2 | 1 | 0 | 0 |
| 2026-053 | 2026 | 1 | 1 | 0 | 0 |
| 2026-054 | 2026 | 2 | 2 | 0 | 0 |
| 2026-055 | 2026 | 1 | 3 | 0 | 0 |
| 2026-056 | 2026 | 2 | 1 | 0 | 0 |
| 2026-057 | 2026 | 1 | 2 | 0 | 0 |
| 2026-058 | 2026 | 2 | 1 | 0 | 0 |
| 2026-059 | 2026 | 3 | 2 | 0 | 0 |
| 2026-060 | 2026 | 1 | 1 | 0 | 0 |
| 2026-061 | 2026 | 2 | 2 | 0 | 0 |
| 2026-062 | 2026 | 1 | 3 | 0 | 0 |
| 2026-063 | 2026 | 2 | 1 | 0 | 0 |
| 2026-064 | 2026 | 1 | 2 | 0 | 0 |
| 2026-065 | 2026 | 2 | 1 | 0 | 0 |
| 2026-066 | 2026 | 1 | 2 | 0 | 0 |
| 2026-067 | 2026 | 2 | 3 | 0 | 0 |
| 2026-068 | 2026 | 1 | 1 | 0 | 0 |
| 2026-069 | 2026 | 2 | 2 | 0 | 0 |
| 2026-070 | 2026 | 1 | 3 | 0 | 0 |
| 2026-071 | 2026 | 2 | 1 | 0 | 0 |
| 2026-072 | 2026 | 1 | 2 | 0 | 0 |
| 2026-073 | 2026 | 3 | 2 | 0 | 1 |
| 2026-074 | 2026 | 4 | 4 | 0 | 0 |
| 2026-075 | 2026 | 2 | 3 | 0 | 0 |
| 2026-076 | 2026 | 1 | 2 | 0 | 0 |
| 2026-077 | 2026 | 3 | 1 | 1 | 0 |
| 2026-078 | 2026 | 2 | 2 | 0 | 0 |
| 2026-079 | 2026 | 1 | 3 | 0 | 1 |
| 2026-080 | 2026 | 2 | 1 | 0 | 0 |
| 2026-081 | 2026 | 3 | 2 | 0 | 0 |
| 2026-082 | 2026 | 1 | 2 | 0 | 0 |
| 2026-083 | 2026 | 2 | 3 | 0 | 0 |
| 2026-084 | 2026 | 1 | 1 | 0 | 0 |
| 2026-085 | 2026 | 2 | 2 | 1 | 0 |
| 2026-086 | 2026 | 1 | 2 | 0 | 0 |
| 2026-087 | 2026 | 3 | 1 | 0 | 0 |
| 2026-088 | 2026 | 2 | 2 | 0 | 0 |
| 2026-089 | 2026 | 1 | 3 | 0 | 0 |
| 2026-090 | 2026 | 2 | 1 | 0 | 0 |
| 2026-091 | 2026 | 3 | 2 | 0 | 0 |
| 2026-092 | 2026 | 1 | 2 | 0 | 1 |
| 2026-093 | 2026 | 2 | 1 | 0 | 0 |
| 2026-094 | 2026 | 1 | 3 | 0 | 0 |
| 2026-095 | 2026 | 0 | 6 | 0 | 1 |
| 2026-096 | 2026 | 2 | 2 | 0 | 0 |
| 2026-097 | 2026 | 3 | 1 | 0 | 0 |
| 2026-098 | 2026 | 2 | 2 | 0 | 0 |
| 2026-099 | 2026 | 1 | 3 | 0 | 0 |
| 2026-100 | 2026 | 2 | 2 | 1 | 1 |
| 2026-101 | 2026 | 2 | 1 | 0 | 0 |
| 2026-102 | 2026 | 1 | 3 | 0 | 0 |
| 2026-103 | 2026 | 0 | 0 | 0 | 0 |
| 2026-104 | 2026 | 0 | 6 | 0 | 1 |

## Validation

- **Total rows: 488.** Confirmed programmatically against the 488 match
  codes present in `data/matches/2002.json` through `data/matches/2026.json`
  (104 committed 2026 matches, including `2026-103` and `2026-104`, both
  added once played).
- **Every repository match appears exactly once** — verified by set
  comparison against the repo's actual match codes: zero missing, zero
  unexpected, zero duplicates.
- **One row per match** — this document is match-level only; no
  tournament-level aggregation and no player-level statistics are included,
  per the milestone's scope.

## Normalization notes

The following are the concrete cross-source discrepancies, ambiguous cases,
and judgment calls found while assembling this document. Every match not
listed here was single- or dual-source-verified with no inconsistency
found.

### 2002 & 2006

- **2006-044** (Croatia v Australia, group F) — the single clearest
  source-vs-source conflict found in this entire milestone. RSSSF's raw
  page only records Josip Šimunić being booked twice (62', 90'). This
  contradicts the extremely well-documented reality — the famous Graham
  Poll refereeing blunder — where Šimunić actually received **three**
  yellow cards (61', 90', 90+3'), and RSSSF also omits a yellow card for
  Niko Kovač (90') entirely. Resolved using Wikipedia's fuller,
  independently-verifiable account instead of RSSSF: Croatia 8Y/2R,
  Australia 2Y/1R.
- **2006-014** (South Korea v Togo, group G) — RSSSF's booking list shows
  Togo's Romao cautioned twice (24', 90+2'), but RSSSF's "Sent off" line
  only names Abalo, not Romao, even though a second caution is
  automatically a red card. Applied the standard rule (counted Romao's
  second yellow as also a red), but this specific inference isn't
  explicitly confirmed by the source text itself.
- **2002-013** (Brazil v Turkey, group C) — trivial notation ambiguity, not
  a real discrepancy. RSSSF's text for Alpay Özalan reads "Y 44' R 86'"
  without the comma used elsewhere on the same page for identical
  second-yellow situations. Treated as equivalent to a second-yellow
  dismissal, consistent with the page's own pattern elsewhere.
- A tournament-level discrepancy was found but does not affect any
  individual match row here: for 2010 and 2014 (see below), RSSSF's own
  hand-maintained end-of-tournament summary figure for total yellow cards
  disagrees with the sum of its own per-match lines (2010: stated 241 vs.
  summed 261; 2014: stated 188 vs. summed 184). Red-card totals agree
  exactly with RSSSF's named "Sent off" lists for both tournaments. This
  document uses the per-match figures throughout, since that is the
  granularity this milestone requires.

### 2010 & 2014

- No individual match required guessing — RSSSF's per-match Cards section
  explicitly lists every card (or explicitly states "none"), so all 128
  rows are directly sourced. Spot-checked against Wikipedia for both
  finals (2010: Netherlands 9Y/1R, Spain 5Y/0R; 2014: Germany 2Y/0R,
  Argentina 2Y/0R) — both matched RSSSF exactly.
- See the tournament-summary-vs-per-match-sum note above.

### 2018 & 2022

- **2022-057** (Netherlands v Argentina quarter-final, "Battle of Lusail")
  — the most contentious case in the dataset. Press widely cites "18
  yellow cards," but that figure includes 2 staff cautions (Argentina
  assistant coach and manager) not counted under team player-card totals
  here. Denzel Dumfries's red card was confirmed via detailed research to
  have occurred **during the penalty shootout** (two yellows in the
  128th/129th shootout minute) and is therefore excluded per this
  document's stated shootout-exclusion rule. Final: Netherlands 8Y/0R,
  Argentina 8Y/0R (players only, regular + extra time only).
- **2022-047** (Serbia v Switzerland) — initial extraction gave 9Y/6Y (15
  total), contradicting the same source page's own prose note of "eleven
  total." Resolved via two independent searches to Serbia 7Y, Switzerland
  4Y (11 total, matching the prose).
- **2022-060** (Morocco v Portugal) — ESPN's simplified box score showed
  1Y/1R for Morocco, but Cheddira's dismissal was confirmed to be a
  genuine second-yellow (two separate stoppage-time cautions), which under
  this document's counting convention means 2Y/1R, not 1Y/1R. Used 2Y/1R.
- **2022-061** (Argentina v Croatia, semi-final) — one search claimed
  "Argentina 2, Croatia 0"; a named-player list and ESPN's box score both
  independently confirmed 2Y/2Y. Used 2/2.
- **2022-034** (Iran v United States) — primary source fetch was truncated
  before this match; resolved via a secondary search to Iran 3Y/1R, US
  0Y/0R.
- **2018-055** (Sweden v Switzerland) — one search result badly garbled
  team attribution ("Switzerland 3 red cards"); ESPN's box score directly
  confirmed the real figures: Sweden 1Y/0R, Switzerland 2Y/1R (Michael
  Lang, stoppage-time dismissal).
- **2018-064** (France v Croatia, final) — three conflicting figures were
  found (a named-player list implying 7 total, Simple Wikipedia saying "3
  total," ESPN saying France 2/Croatia 1 = 3 total). Trusted the two
  agreeing structured sources over the named list, which appears to
  conflate cards from other matches involving the same players.
- **2018-053** (Brazil v Mexico) — Simple Wikipedia gave "6 total, 0 red"
  without a team split; ESPN's box score independently confirmed both the
  split (Brazil 2, Mexico 4) and the total.
- Of the 128 2018/2022 matches, 120 were single-source (Wikipedia, citing
  official FIFA match reports) with no internal inconsistency found; the 8
  above required a second source to resolve a genuine ambiguity, all
  documented.

### 2026

- Primary source: FIFA's live match-timeline API. All 102 matches matched
  to repo codes by kickoff timestamp + team pairing with zero ambiguous
  ties; all timeline fetches succeeded.
- **2026-101** (France v Spain semi-final) — a WebSearch summary suggested
  3 yellow cards for France, but FIFA's raw timeline shows only 2 distinct
  card events (different players/minutes); the search summary appears to
  have restated one event twice. Resolved in favor of FIFA's raw event log
  (2 yellows for France).
- **2026-095** (Argentina v Egypt, round of 16) — a genuine outlier: 6
  yellow + 1 red, all for Egypt, concentrated in second-half stoppage time
  (90'+3 to 90'+9). Cross-checked against press coverage of a dramatic
  stoppage-time Argentina comeback (a 2-goal deficit overturned, winner
  scored 90'+2') — verified as real, not a data error.
- **2026-001** (Mexico v South Africa, opener) — fully cross-checked
  against independent press with matching player-level detail (3 reds
  total: 1 Mexico, 2 South Africa) — no discrepancy.
- 4 of the 102 matches (2026-001, 2026-095, 2026-101, and 2026-102, the
  latter via prior-session press cross-checks) were dual-sourced; the
  remaining 98 rely on FIFA's official live timeline as a single
  authoritative primary source, consistent with this project's existing
  `api.fifa.com` convention.
- **2026-103** (France v England, third-place play-off) — added once played.
  FIFA's live timeline returned an empty `Bookings` array for both teams (0Y
  0R each side). Plausible for a dead-rubber fixture with little riding on
  it, and consistent with the same endpoint returning genuine non-empty
  card data for the very next match fetched (`2026-104`, below) — treated as
  a confirmed zero, not a fetch failure.
- **2026-104** (Spain v Argentina, final) — added once played. FIFA's live
  timeline: Spain 0Y/0R; Argentina 5 distinct player caution events plus a
  second-yellow dismissal for the same player (IdPlayer `448252`, cautioned
  82', dismissed via second yellow 90'+3') — applying this document's
  standard second-yellow convention (counted as both a yellow and a red for
  that player) gives Argentina 6Y/1R. A sixth caution recorded in the raw
  feed (a bench/coaching-staff yellow at 105') was excluded from the team
  total per this document's established staff-card exclusion rule (see the
  `2022-057` note above).

### Confidence overview across all 488 matches

| Tournament(s) | Matches | High confidence | Flagged / dual-sourced |
|---|---|---|---|
| 2002 + 2006 | 128 | 125 | 3 (1 corrected, 2 minor) |
| 2010 + 2014 | 128 | 128 | 0 (one tournament-summary drift noted, no match-level impact) |
| 2018 + 2022 | 128 | 120 | 8 (all resolved) |
| 2026 | 104 | 98 (single authoritative source) | 6 (dual-sourced or individually annotated) |
| **Total** | **488** | — | **17 matches flagged, all resolved and documented above** |

No match in this document has an unresolved or unsourced value.

## Cards summary

- **Total matches:** 488
- **Total yellow cards:** 1,871
- **Total red cards:** 89
- **Average yellow cards per match:** 3.83
- **Average red cards per match:** 0.18
- **Highest yellow-card match:** three-way tie at 16 total yellow cards —
  `2006-052` (Portugal v Netherlands, round of 16, the "Battle of
  Nuremberg": 9 Team A + 7 Team B), `2002-035` (Cameroon v Germany, group E: 8
  + 8), and `2022-057` (Netherlands v Argentina, quarter-final, the
  "Battle of Lusail": 8 + 8).
- **Highest red-card match:** `2006-052` (Portugal v Netherlands, round of
  16, the "Battle of Nuremberg") — 4 total red cards (2 Team A + 2 Team B),
  also the highest-yellow match above; this is the most heavily disciplined
  match in World Cup history and is independently well documented as such.

