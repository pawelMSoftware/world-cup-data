# World Cup Attendance — Match Mapping (2002–2026)

> This document is the canonical source for World Cup match attendance.
>
> Future machine-readable datasets should be generated from this document
> rather than edited manually.

This document maps every World Cup match currently present in this
repository (2002–2026, 488 matches total) to its official
attendance figure. It is a data-preparation document, not a machine-readable
dataset — no JSON is generated from it as part of this milestone.

## Method

- **Match** = the repository's match code (`data/matches/{year}.json`, `code` field).
- **Tournament** = the World Cup year the match belongs to.
- **Attendance** = the official reported number of spectators for the match, as
  plain integer (no thousands separators, no formatting).
- 2026 covers all 104 matches now committed to the repository, including the
  3rd-place match (`2026-103`) and the final (`2026-104`), both added after
  this document's initial version once played.

### Sources

Source priority, applied per tournament:

1. **FIFA** official match reports / FIFA live competition API — used as the
   primary source for 2026, and as a cross-check reference where available for
   earlier tournaments.
2. **RSSSF** (`rsssf.org`) — per-tournament full match-detail tables; primary
   source for 2002, 2010, and 2018.
3. **Wikipedia** match/group articles (citing FIFA official match reports) —
   primary source for 2006, 2014, 2022, and 2026; used as a cross-check
   against RSSSF for 2002, 2010, and 2018.

Values were cross-checked against a second source wherever feasible. Where
sources disagreed, the discrepancy is documented in Normalization notes below
and the more authoritative figure (FIFA > RSSSF > Wikipedia) was used.

## Match → attendance mapping (488 rows)

| Match | Tournament | Attendance |
|---|---|---|
| 2002-001 | 2002 | 62561 |
| 2002-002 | 2002 | 33679 |
| 2002-003 | 2002 | 30157 |
| 2002-004 | 2002 | 32218 |
| 2002-005 | 2002 | 52721 |
| 2002-006 | 2002 | 25186 |
| 2002-007 | 2002 | 34050 |
| 2002-008 | 2002 | 28598 |
| 2002-009 | 2002 | 32239 |
| 2002-010 | 2002 | 33842 |
| 2002-011 | 2002 | 31081 |
| 2002-012 | 2002 | 27217 |
| 2002-013 | 2002 | 55256 |
| 2002-014 | 2002 | 48760 |
| 2002-015 | 2002 | 30957 |
| 2002-016 | 2002 | 37306 |
| 2002-017 | 2002 | 35854 |
| 2002-018 | 2002 | 38289 |
| 2002-019 | 2002 | 52328 |
| 2002-020 | 2002 | 43500 |
| 2002-021 | 2002 | 36194 |
| 2002-022 | 2002 | 24000 |
| 2002-023 | 2002 | 35927 |
| 2002-024 | 2002 | 47226 |
| 2002-025 | 2002 | 36472 |
| 2002-026 | 2002 | 36750 |
| 2002-027 | 2002 | 45610 |
| 2002-028 | 2002 | 42299 |
| 2002-029 | 2002 | 66108 |
| 2002-030 | 2002 | 60778 |
| 2002-031 | 2002 | 39700 |
| 2002-032 | 2002 | 31000 |
| 2002-033 | 2002 | 48100 |
| 2002-034 | 2002 | 33681 |
| 2002-035 | 2002 | 47085 |
| 2002-036 | 2002 | 65320 |
| 2002-037 | 2002 | 45777 |
| 2002-038 | 2002 | 44864 |
| 2002-039 | 2002 | 31024 |
| 2002-040 | 2002 | 30176 |
| 2002-041 | 2002 | 38524 |
| 2002-042 | 2002 | 43605 |
| 2002-043 | 2002 | 39291 |
| 2002-044 | 2002 | 65862 |
| 2002-045 | 2002 | 45213 |
| 2002-046 | 2002 | 46640 |
| 2002-047 | 2002 | 50239 |
| 2002-048 | 2002 | 26482 |
| 2002-049 | 2002 | 25176 |
| 2002-050 | 2002 | 40582 |
| 2002-051 | 2002 | 39747 |
| 2002-052 | 2002 | 38926 |
| 2002-053 | 2002 | 36380 |
| 2002-054 | 2002 | 40440 |
| 2002-055 | 2002 | 45666 |
| 2002-056 | 2002 | 38588 |
| 2002-057 | 2002 | 47436 |
| 2002-058 | 2002 | 37337 |
| 2002-059 | 2002 | 42114 |
| 2002-060 | 2002 | 44233 |
| 2002-061 | 2002 | 65256 |
| 2002-062 | 2002 | 61058 |
| 2002-063 | 2002 | 63483 |
| 2002-064 | 2002 | 69029 |
| 2006-001 | 2006 | 66000 |
| 2006-002 | 2006 | 52000 |
| 2006-003 | 2006 | 48000 |
| 2006-004 | 2006 | 62959 |
| 2006-005 | 2006 | 49480 |
| 2006-006 | 2006 | 43000 |
| 2006-007 | 2006 | 41000 |
| 2006-008 | 2006 | 45000 |
| 2006-009 | 2006 | 43000 |
| 2006-010 | 2006 | 52000 |
| 2006-011 | 2006 | 72000 |
| 2006-012 | 2006 | 46000 |
| 2006-013 | 2006 | 52000 |
| 2006-014 | 2006 | 48000 |
| 2006-015 | 2006 | 43000 |
| 2006-016 | 2006 | 66000 |
| 2006-017 | 2006 | 65000 |
| 2006-018 | 2006 | 50000 |
| 2006-019 | 2006 | 41000 |
| 2006-020 | 2006 | 72000 |
| 2006-021 | 2006 | 52000 |
| 2006-022 | 2006 | 52000 |
| 2006-023 | 2006 | 43000 |
| 2006-024 | 2006 | 48000 |
| 2006-025 | 2006 | 46000 |
| 2006-026 | 2006 | 45000 |
| 2006-027 | 2006 | 66000 |
| 2006-028 | 2006 | 41000 |
| 2006-029 | 2006 | 43000 |
| 2006-030 | 2006 | 65000 |
| 2006-031 | 2006 | 52000 |
| 2006-032 | 2006 | 50000 |
| 2006-033 | 2006 | 72000 |
| 2006-034 | 2006 | 43000 |
| 2006-035 | 2006 | 45000 |
| 2006-036 | 2006 | 46000 |
| 2006-037 | 2006 | 48000 |
| 2006-038 | 2006 | 66000 |
| 2006-039 | 2006 | 52000 |
| 2006-040 | 2006 | 38000 |
| 2006-041 | 2006 | 50000 |
| 2006-042 | 2006 | 41000 |
| 2006-043 | 2006 | 65000 |
| 2006-044 | 2006 | 52000 |
| 2006-045 | 2006 | 45000 |
| 2006-046 | 2006 | 43000 |
| 2006-047 | 2006 | 46000 |
| 2006-048 | 2006 | 72000 |
| 2006-049 | 2006 | 66000 |
| 2006-050 | 2006 | 43000 |
| 2006-051 | 2006 | 52000 |
| 2006-052 | 2006 | 41000 |
| 2006-053 | 2006 | 46000 |
| 2006-054 | 2006 | 45000 |
| 2006-055 | 2006 | 65000 |
| 2006-056 | 2006 | 43000 |
| 2006-057 | 2006 | 72000 |
| 2006-058 | 2006 | 50000 |
| 2006-059 | 2006 | 52000 |
| 2006-060 | 2006 | 48000 |
| 2006-061 | 2006 | 65000 |
| 2006-062 | 2006 | 66000 |
| 2006-063 | 2006 | 52000 |
| 2006-064 | 2006 | 69000 |
| 2010-001 | 2010 | 84490 |
| 2010-002 | 2010 | 64100 |
| 2010-003 | 2010 | 55686 |
| 2010-004 | 2010 | 31513 |
| 2010-005 | 2010 | 38646 |
| 2010-006 | 2010 | 30325 |
| 2010-007 | 2010 | 62660 |
| 2010-008 | 2010 | 38833 |
| 2010-009 | 2010 | 83465 |
| 2010-010 | 2010 | 30620 |
| 2010-011 | 2010 | 62869 |
| 2010-012 | 2010 | 23871 |
| 2010-013 | 2010 | 37034 |
| 2010-014 | 2010 | 54331 |
| 2010-015 | 2010 | 32664 |
| 2010-016 | 2010 | 62453 |
| 2010-017 | 2010 | 42658 |
| 2010-018 | 2010 | 35370 |
| 2010-019 | 2010 | 31593 |
| 2010-020 | 2010 | 82174 |
| 2010-021 | 2010 | 38294 |
| 2010-022 | 2010 | 45573 |
| 2010-023 | 2010 | 64100 |
| 2010-024 | 2010 | 34812 |
| 2010-025 | 2010 | 62010 |
| 2010-026 | 2010 | 38074 |
| 2010-027 | 2010 | 26643 |
| 2010-028 | 2010 | 38229 |
| 2010-029 | 2010 | 84455 |
| 2010-030 | 2010 | 63644 |
| 2010-031 | 2010 | 34872 |
| 2010-032 | 2010 | 54386 |
| 2010-033 | 2010 | 33425 |
| 2010-034 | 2010 | 39415 |
| 2010-035 | 2010 | 61874 |
| 2010-036 | 2010 | 38891 |
| 2010-037 | 2010 | 36893 |
| 2010-038 | 2010 | 35827 |
| 2010-039 | 2010 | 83391 |
| 2010-040 | 2010 | 37836 |
| 2010-041 | 2010 | 53412 |
| 2010-042 | 2010 | 34850 |
| 2010-043 | 2010 | 27967 |
| 2010-044 | 2010 | 63093 |
| 2010-045 | 2010 | 62712 |
| 2010-046 | 2010 | 34763 |
| 2010-047 | 2010 | 41958 |
| 2010-048 | 2010 | 28042 |
| 2010-049 | 2010 | 30597 |
| 2010-050 | 2010 | 34976 |
| 2010-051 | 2010 | 40510 |
| 2010-052 | 2010 | 84377 |
| 2010-053 | 2010 | 61962 |
| 2010-054 | 2010 | 54096 |
| 2010-055 | 2010 | 36742 |
| 2010-056 | 2010 | 62955 |
| 2010-057 | 2010 | 40186 |
| 2010-058 | 2010 | 84017 |
| 2010-059 | 2010 | 64100 |
| 2010-060 | 2010 | 55359 |
| 2010-061 | 2010 | 62479 |
| 2010-062 | 2010 | 60960 |
| 2010-063 | 2010 | 36254 |
| 2010-064 | 2010 | 84490 |
| 2014-001 | 2014 | 62103 |
| 2014-002 | 2014 | 39216 |
| 2014-003 | 2014 | 48173 |
| 2014-004 | 2014 | 40275 |
| 2014-005 | 2014 | 57174 |
| 2014-006 | 2014 | 40267 |
| 2014-007 | 2014 | 58679 |
| 2014-008 | 2014 | 39800 |
| 2014-009 | 2014 | 68351 |
| 2014-010 | 2014 | 43012 |
| 2014-011 | 2014 | 74738 |
| 2014-012 | 2014 | 39081 |
| 2014-013 | 2014 | 51081 |
| 2014-014 | 2014 | 39760 |
| 2014-015 | 2014 | 56800 |
| 2014-016 | 2014 | 37603 |
| 2014-017 | 2014 | 60342 |
| 2014-018 | 2014 | 39982 |
| 2014-019 | 2014 | 74101 |
| 2014-020 | 2014 | 42877 |
| 2014-021 | 2014 | 68748 |
| 2014-022 | 2014 | 39485 |
| 2014-023 | 2014 | 62575 |
| 2014-024 | 2014 | 40285 |
| 2014-025 | 2014 | 51003 |
| 2014-026 | 2014 | 39224 |
| 2014-027 | 2014 | 57698 |
| 2014-028 | 2014 | 40499 |
| 2014-029 | 2014 | 59621 |
| 2014-030 | 2014 | 40123 |
| 2014-031 | 2014 | 73819 |
| 2014-032 | 2014 | 42732 |
| 2014-033 | 2014 | 69112 |
| 2014-034 | 2014 | 41212 |
| 2014-035 | 2014 | 39375 |
| 2014-036 | 2014 | 62996 |
| 2014-037 | 2014 | 40340 |
| 2014-038 | 2014 | 59095 |
| 2014-039 | 2014 | 39706 |
| 2014-040 | 2014 | 57823 |
| 2014-041 | 2014 | 40322 |
| 2014-042 | 2014 | 73749 |
| 2014-043 | 2014 | 43285 |
| 2014-044 | 2014 | 48011 |
| 2014-045 | 2014 | 41876 |
| 2014-046 | 2014 | 67540 |
| 2014-047 | 2014 | 61397 |
| 2014-048 | 2014 | 39311 |
| 2014-049 | 2014 | 57714 |
| 2014-050 | 2014 | 73804 |
| 2014-051 | 2014 | 58817 |
| 2014-052 | 2014 | 41242 |
| 2014-053 | 2014 | 67882 |
| 2014-054 | 2014 | 43063 |
| 2014-055 | 2014 | 63255 |
| 2014-056 | 2014 | 51227 |
| 2014-057 | 2014 | 60342 |
| 2014-058 | 2014 | 74240 |
| 2014-059 | 2014 | 51179 |
| 2014-060 | 2014 | 68551 |
| 2014-061 | 2014 | 58141 |
| 2014-062 | 2014 | 63267 |
| 2014-063 | 2014 | 68034 |
| 2014-064 | 2014 | 74738 |
| 2018-001 | 2018 | 78011 |
| 2018-002 | 2018 | 27015 |
| 2018-003 | 2018 | 43866 |
| 2018-004 | 2018 | 62548 |
| 2018-005 | 2018 | 41279 |
| 2018-006 | 2018 | 40502 |
| 2018-007 | 2018 | 44190 |
| 2018-008 | 2018 | 31136 |
| 2018-009 | 2018 | 43109 |
| 2018-010 | 2018 | 41432 |
| 2018-011 | 2018 | 78011 |
| 2018-012 | 2018 | 42300 |
| 2018-013 | 2018 | 43257 |
| 2018-014 | 2018 | 41064 |
| 2018-015 | 2018 | 44190 |
| 2018-016 | 2018 | 40842 |
| 2018-017 | 2018 | 64468 |
| 2018-018 | 2018 | 42678 |
| 2018-019 | 2018 | 78011 |
| 2018-020 | 2018 | 42718 |
| 2018-021 | 2018 | 32789 |
| 2018-022 | 2018 | 40727 |
| 2018-023 | 2018 | 43319 |
| 2018-024 | 2018 | 40904 |
| 2018-025 | 2018 | 64468 |
| 2018-026 | 2018 | 33167 |
| 2018-027 | 2018 | 44287 |
| 2018-028 | 2018 | 43472 |
| 2018-029 | 2018 | 44190 |
| 2018-030 | 2018 | 43319 |
| 2018-031 | 2018 | 42873 |
| 2018-032 | 2018 | 32572 |
| 2018-033 | 2018 | 41970 |
| 2018-034 | 2018 | 36823 |
| 2018-035 | 2018 | 41685 |
| 2018-036 | 2018 | 33973 |
| 2018-037 | 2018 | 78011 |
| 2018-038 | 2018 | 44073 |
| 2018-039 | 2018 | 64468 |
| 2018-040 | 2018 | 43472 |
| 2018-041 | 2018 | 44190 |
| 2018-042 | 2018 | 43319 |
| 2018-043 | 2018 | 41835 |
| 2018-044 | 2018 | 33061 |
| 2018-045 | 2018 | 33973 |
| 2018-046 | 2018 | 37168 |
| 2018-047 | 2018 | 42189 |
| 2018-048 | 2018 | 41970 |
| 2018-049 | 2018 | 44287 |
| 2018-050 | 2018 | 42873 |
| 2018-051 | 2018 | 78011 |
| 2018-052 | 2018 | 40851 |
| 2018-053 | 2018 | 41970 |
| 2018-054 | 2018 | 41466 |
| 2018-055 | 2018 | 64042 |
| 2018-056 | 2018 | 44190 |
| 2018-057 | 2018 | 43319 |
| 2018-058 | 2018 | 42873 |
| 2018-059 | 2018 | 44287 |
| 2018-060 | 2018 | 39991 |
| 2018-061 | 2018 | 64286 |
| 2018-062 | 2018 | 78011 |
| 2018-063 | 2018 | 64406 |
| 2018-064 | 2018 | 78011 |
| 2022-001 | 2022 | 67372 |
| 2022-002 | 2022 | 41721 |
| 2022-003 | 2022 | 45334 |
| 2022-004 | 2022 | 43418 |
| 2022-005 | 2022 | 40875 |
| 2022-006 | 2022 | 42925 |
| 2022-007 | 2022 | 39369 |
| 2022-008 | 2022 | 88012 |
| 2022-009 | 2022 | 40432 |
| 2022-010 | 2022 | 40013 |
| 2022-011 | 2022 | 42608 |
| 2022-012 | 2022 | 59407 |
| 2022-013 | 2022 | 39089 |
| 2022-014 | 2022 | 41663 |
| 2022-015 | 2022 | 42662 |
| 2022-016 | 2022 | 88103 |
| 2022-017 | 2022 | 40875 |
| 2022-018 | 2022 | 41797 |
| 2022-019 | 2022 | 44833 |
| 2022-020 | 2022 | 68463 |
| 2022-021 | 2022 | 41823 |
| 2022-022 | 2022 | 44259 |
| 2022-023 | 2022 | 42860 |
| 2022-024 | 2022 | 88966 |
| 2022-025 | 2022 | 41479 |
| 2022-026 | 2022 | 43738 |
| 2022-027 | 2022 | 44374 |
| 2022-028 | 2022 | 68895 |
| 2022-029 | 2022 | 39789 |
| 2022-030 | 2022 | 43983 |
| 2022-031 | 2022 | 43649 |
| 2022-032 | 2022 | 88668 |
| 2022-033 | 2022 | 44297 |
| 2022-034 | 2022 | 42127 |
| 2022-035 | 2022 | 44569 |
| 2022-036 | 2022 | 66784 |
| 2022-037 | 2022 | 41232 |
| 2022-038 | 2022 | 43627 |
| 2022-039 | 2022 | 44089 |
| 2022-040 | 2022 | 84985 |
| 2022-041 | 2022 | 43984 |
| 2022-042 | 2022 | 43102 |
| 2022-043 | 2022 | 44851 |
| 2022-044 | 2022 | 67054 |
| 2022-045 | 2022 | 43443 |
| 2022-046 | 2022 | 44097 |
| 2022-047 | 2022 | 41378 |
| 2022-048 | 2022 | 85986 |
| 2022-049 | 2022 | 44846 |
| 2022-050 | 2022 | 45032 |
| 2022-051 | 2022 | 65985 |
| 2022-052 | 2022 | 40989 |
| 2022-053 | 2022 | 42523 |
| 2022-054 | 2022 | 43847 |
| 2022-055 | 2022 | 44667 |
| 2022-056 | 2022 | 83720 |
| 2022-057 | 2022 | 88235 |
| 2022-058 | 2022 | 43893 |
| 2022-059 | 2022 | 68895 |
| 2022-060 | 2022 | 44198 |
| 2022-061 | 2022 | 88966 |
| 2022-062 | 2022 | 68294 |
| 2022-063 | 2022 | 44137 |
| 2022-064 | 2022 | 88966 |
| 2026-001 | 2026 | 80824 |
| 2026-002 | 2026 | 44985 |
| 2026-003 | 2026 | 43002 |
| 2026-004 | 2026 | 70492 |
| 2026-005 | 2026 | 64146 |
| 2026-006 | 2026 | 52497 |
| 2026-007 | 2026 | 80663 |
| 2026-008 | 2026 | 67966 |
| 2026-009 | 2026 | 68274 |
| 2026-010 | 2026 | 68021 |
| 2026-011 | 2026 | 69285 |
| 2026-012 | 2026 | 50987 |
| 2026-013 | 2026 | 62764 |
| 2026-014 | 2026 | 67640 |
| 2026-015 | 2026 | 70108 |
| 2026-016 | 2026 | 66775 |
| 2026-017 | 2026 | 80545 |
| 2026-018 | 2026 | 63106 |
| 2026-019 | 2026 | 69045 |
| 2026-020 | 2026 | 68527 |
| 2026-021 | 2026 | 42942 |
| 2026-022 | 2026 | 70389 |
| 2026-023 | 2026 | 68777 |
| 2026-024 | 2026 | 80824 |
| 2026-025 | 2026 | 67442 |
| 2026-026 | 2026 | 70026 |
| 2026-027 | 2026 | 52497 |
| 2026-028 | 2026 | 45522 |
| 2026-029 | 2026 | 68324 |
| 2026-030 | 2026 | 64146 |
| 2026-031 | 2026 | 68827 |
| 2026-032 | 2026 | 66925 |
| 2026-033 | 2026 | 43036 |
| 2026-034 | 2026 | 68598 |
| 2026-035 | 2026 | 68777 |
| 2026-036 | 2026 | 51243 |
| 2026-037 | 2026 | 64003 |
| 2026-038 | 2026 | 68239 |
| 2026-039 | 2026 | 70317 |
| 2026-040 | 2026 | 52497 |
| 2026-041 | 2026 | 80663 |
| 2026-042 | 2026 | 68324 |
| 2026-043 | 2026 | 70649 |
| 2026-044 | 2026 | 68371 |
| 2026-045 | 2026 | 63983 |
| 2026-046 | 2026 | 43036 |
| 2026-047 | 2026 | 68777 |
| 2026-048 | 2026 | 45358 |
| 2026-049 | 2026 | 64478 |
| 2026-050 | 2026 | 68239 |
| 2026-051 | 2026 | 52497 |
| 2026-052 | 2026 | 66925 |
| 2026-053 | 2026 | 80824 |
| 2026-054 | 2026 | 51243 |
| 2026-055 | 2026 | 68324 |
| 2026-056 | 2026 | 80663 |
| 2026-057 | 2026 | 70137 |
| 2026-058 | 2026 | 68391 |
| 2026-059 | 2026 | 70492 |
| 2026-060 | 2026 | 68827 |
| 2026-061 | 2026 | 64146 |
| 2026-062 | 2026 | 43036 |
| 2026-063 | 2026 | 66925 |
| 2026-064 | 2026 | 52497 |
| 2026-065 | 2026 | 68278 |
| 2026-066 | 2026 | 45065 |
| 2026-067 | 2026 | 80663 |
| 2026-068 | 2026 | 68324 |
| 2026-069 | 2026 | 69045 |
| 2026-070 | 2026 | 70649 |
| 2026-071 | 2026 | 64478 |
| 2026-072 | 2026 | 68239 |
| 2026-073 | 2026 | 69237 |
| 2026-074 | 2026 | 63945 |
| 2026-075 | 2026 | 51243 |
| 2026-076 | 2026 | 68777 |
| 2026-077 | 2026 | 80663 |
| 2026-078 | 2026 | 69665 |
| 2026-079 | 2026 | 80824 |
| 2026-080 | 2026 | 68239 |
| 2026-081 | 2026 | 68827 |
| 2026-082 | 2026 | 66925 |
| 2026-083 | 2026 | 43036 |
| 2026-084 | 2026 | 70492 |
| 2026-085 | 2026 | 52497 |
| 2026-086 | 2026 | 64478 |
| 2026-087 | 2026 | 69045 |
| 2026-088 | 2026 | 70244 |
| 2026-089 | 2026 | 68324 |
| 2026-090 | 2026 | 68777 |
| 2026-091 | 2026 | 80663 |
| 2026-092 | 2026 | 80824 |
| 2026-093 | 2026 | 70649 |
| 2026-094 | 2026 | 66925 |
| 2026-095 | 2026 | 68239 |
| 2026-096 | 2026 | 52497 |
| 2026-097 | 2026 | 63811 |
| 2026-098 | 2026 | 70492 |
| 2026-099 | 2026 | 64478 |
| 2026-100 | 2026 | 69045 |
| 2026-101 | 2026 | 70176 |
| 2026-102 | 2026 | 68239 |
| 2026-103 | 2026 | 64478 |
| 2026-104 | 2026 | 80663 |

## Validation

- Every one of the 488 matches present in `data/matches/*.json`
  (2002–2022: 64 matches × 6 tournaments; 2026: 104 committed matches) appears
  exactly once in the table above.
- No duplicate match codes.
- No missing matches.
- No estimated values — every row has a sourced, verified attendance figure;
  there are zero `UNKNOWN` entries.
- Every attendance value is a plain integer with no thousands separators,
  spaces, commas, dots, or underscores.

## Normalization notes

- **2002**: figures are exact (non-rounded) turnstile-style attendance counts
  sourced from RSSSF's full match-detail table, with one gap-fill via
  independent search (`2002-011`, Italy v Ecuador — omitted from the initially
  fetched RSSSF table, confirmed at 31,081 via a secondary source).
- **2006**: official attendance figures for this tournament are documented as
  largely round-thousand "announced" numbers (ticket-sold/capacity based)
  rather than exact turnstile counts — this is a known characteristic of 2006's
  official reporting, not a data-quality gap on this document's part. Four
  matches showed a discrepancy between RSSSF's turnstile-style figure and
  Wikipedia's rounder official/announced figure; the official Wikipedia figure
  was used in each case since it reconciles exactly with FIFA's stated
  tournament total (3,359,439 across 64 matches):
  - `2006-001` (Germany v Costa Rica): RSSSF 64,950 vs. official 66,000 → used 66,000
  - `2006-002` (Poland v Ecuador): RSSSF 48,426 vs. official 52,000 → used 52,000
  - `2006-006` (Serbia and Montenegro v Netherlands): RSSSF 37,216 vs. official 43,000 → used 43,000
  - `2006-040` (Iran v Angola): RSSSF 43,000 vs. official 38,000 → used 38,000 (confirmed via two independent searches)
  - The sum of all 64 collected 2006 figures (3,359,439) matches Wikipedia's
    independently stated tournament total exactly, giving high confidence in
    the full set.
- **2010**: RSSSF's fetched match-detail table omitted attendance for 3
  matches (Germany v Serbia, Nigeria v South Korea, Greece v Argentina); these
  were sourced independently via secondary reputable sources (ESPN/Wikipedia).
  Repeated identical values across different matches at the same stadium (e.g.
  64,100 at Cape Town for both `2010-005` and `2010-023`; 84,490 at Soccer
  City for both the opener `2010-001` and the final `2010-064`) reflect
  genuine repeated sellout/capacity figures, not a transcription error.
- **2014**: RSSSF's tournament table contained no per-match attendance data
  (only the final), so all 2014 figures were sourced from Wikipedia's
  per-group and knockout-stage match tables. Two Round-of-16 figures
  (`2014-055` Argentina v Switzerland, `2014-056` Belgium v USA) were
  corrected mid-research after an initial search returned imprecise values;
  the final figures used (63,255 and 51,227 respectively) are the verified,
  source-confirmed ones.
- **2018**: RSSSF's full match-detail table was the primary source,
  cross-checked against Wikipedia's group and knockout-stage articles with no
  discrepancies found. Several matches at the same venue repeat an identical
  attendance figure equal to that stadium's listed capacity (e.g. Luzhniki
  Stadium, Moscow = 78,011 for all 7 matches held there, including
  `2018-001`, `2018-011`, `2018-019`, `2018-037`, `2018-051`, `2018-062`,
  `2018-064`) — independently corroborated across sources for each individual
  match, not a copy-paste artifact.
- **2022**: sourced from Wikipedia's per-group and knockout-stage articles,
  cross-checked against independent searches for every knockout match and
  `2022-034` (Iran v USA) via fbref.com. Qatar 2022's official attendance
  figures are widely understood by external observers to reflect tickets
  sold/allocated at or near listed capacity rather than actual turnstile
  counts, particularly for the larger stadiums (Lusail, Al Bayt) in the
  knockout rounds. This document uses FIFA's official reported attendance
  regardless, per the stated source-priority rule — no adjustment made for
  this known caveat. As with other tournaments, repeated identical values at
  the same venue (e.g. Lusail Stadium = 88,966 for `2022-024`, `2022-061`,
  `2022-064`) reflect genuine repeated sellout/capacity figures.
- **2026**: sourced from Wikipedia's per-group and per-round articles (which
  cite FIFA official match reports), retrieved via section-level API calls
  after full-page fetches were found to silently truncate large articles
  (e.g. the Round of 32 page cut off after 12 of 16 matches on the first
  fetch attempt) — resolved by fetching each match's wikitext section
  individually. No conflicting figures were found across sources for any
  2026 match. As with earlier tournaments, several matches at the same venue
  repeat an identical attendance figure reflecting that stadium's fixed
  capacity (e.g. 68,239 for `2026-038`, `2026-050`, `2026-072`, `2026-080`,
  `2026-095`, `2026-102`). `2026-103` (3rd-place, Hard Rock Stadium/Miami) and
  `2026-104` (final, MetLife Stadium/New York-New Jersey) were both unplayed
  at this document's initial version and were added once played, sourced
  directly from FIFA's live competition API (`api.fifa.com`,
  `IdMatch: 400021542` and `IdMatch: 400021543` respectively) per this
  document's stated source-priority rule, rather than Wikipedia — FIFA's
  figure was checked and found to match the same value already on file for a
  different match at the same venue (`2026-103`: 64,478, matching `2026-099`
  at Hard Rock Stadium; `2026-104`: 80,663, matching `2026-091` at MetLife
  Stadium), consistent with the repeated-capacity pattern seen throughout this
  tournament.

## Attendance summary

- **Total matches**: 488
- **Total attendance**: 25,920,351
- **Average attendance**: 53,115.47
- **Highest attendance**: 88,966
  - `2022-024` (2022) — 88966
  - `2022-061` (2022) — 88966
  - `2022-064` (2022) — 88966
- **Lowest attendance**: 23,871
  - `2010-012` (2010) — 23871
