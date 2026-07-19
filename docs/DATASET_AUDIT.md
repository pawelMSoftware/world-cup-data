# Dataset Audit Report — world-cup-data v1.0.0 release candidate

Audit date reference: 2026-07-14 (re-audited after fixing match `2022-046`; this revision adds a full
categorisation of every warning). Every match under `data/matches/` was compared field-by-field against
the official FIFA competition API (`api.fifa.com/api/v3/calendar/matches`, the same backend used by
fifa.com's Match Centre) — no Wikipedia, no third-party football sites.

**This is an audit only. No JSON data files were modified.**

---

## Summary

- **Total matches audited:** 486
- **Matches with zero issues:** 257
- **Matches with at least one warning:** 229
- **Matches with at least one error:** 0
- **Total warning findings:** 229
- **Total error findings:** 0
- **Matches present in FIFA but missing locally:** 2
- **Matches present locally but missing in FIFA:** 0
- **Duplicate UUIDs found:** 0
- **Duplicate match codes found:** 0

### Warning categories

| Warning category | Count |
|-----------------|------:|
| Stadium branding differences | 33 |
| Historical stadium names | 18 |
| City label differences | 19 |
| Administrative area differences | 39 |
| Other | 120 |
| **Total** | **229** |

---

## Warning categories in detail

### Stadium branding differences

**Count:** 33 finding(s) across 6 distinct OpenFootball/FIFA naming pair(s).

Example:

OpenFootball:

```text
Gottlieb-Daimler-Stadion
```

FIFA:

```text
Mercedes-Benz Arena
```

Reason:

Daimler consolidated its stadium-naming rights under the Mercedes-Benz brand.

Action:

No change required.

**Why this warning exists:** Naming-rights sponsors change over a stadium's lifetime (bankruptcy, contract expiry, rebrand). OpenFootball records the name that was actually in use during that World Cup; FIFA's live database reflects whichever sponsor holds the naming rights today, which can be a different company than in the tournament year.

**Same physical entity?** Yes - same physical stadium, different commercial sponsor name at different points in time.

**Should the dataset be changed?** No. No action required — every pair below refers to the same
real-world stadium/city as the local record; changing the stored value would trade one correct
label for another, equally correct, label, and risk losing the tournament-accurate name. Local
stadium `name`/`city` values were deliberately generated to preserve the era-appropriate name
(the prior stadium-generation milestone explicitly kept, e.g., `AWD-Arena` rather than renaming it
to a later sponsor's name) — documented in
[`docs/CONVENTIONS.md`](CONVENTIONS.md#stadium-naming-policy).

<details>
<summary>All 6 pair(s) in this category</summary>

| OpenFootball | FIFA | Matches | Reason |
|---|---|---:|---|
| Gottlieb-Daimler-Stadion | Mercedes-Benz Arena | 6 | Daimler consolidated its stadium-naming rights under the Mercedes-Benz brand. |
| Kazan Arena | Ak Bars Arena | 6 | Naming rights sold to Ak Bars (the local ice-hockey club's sponsor). |
| Arena de São Paulo | Neo Química Arena | 6 | Corinthians sold the stadium's naming rights to Neo Química. |
| AOL Arena | Volksparkstadion | 5 | AOL's sponsorship ended; the stadium reverted to its neutral name. |
| AWD-Arena | HDI-Arena | 5 | AWD (insurer) went bankrupt; naming rights passed to HDI (also an insurer). |
| Spartak Stadium | Otkrytiye Arena | 5 | Naming rights sold to Otkritie Bank. |

</details>

### Historical stadium names

**Count:** 18 finding(s) across 3 distinct OpenFootball/FIFA naming pair(s).

Example:

OpenFootball:

```text
Luzhniki Stadium
```

FIFA:

```text
Lenin
```

Reason:

Luzhniki was known as "V. I. Lenin Central Stadium" for most of the Soviet era; FIFA's record still carries that name.

Action:

No change required.

**Why this warning exists:** Some stadiums carry a long-standing traditional or Soviet-era name alongside their modern one. FIFA's dataset in these cases surfaces the older/alternate name rather than the name commonly used today.

**Same physical entity?** Yes - same physical stadium, FIFA's record uses a traditional/Soviet-era/heritage name instead of the current one.

**Should the dataset be changed?** No. No action required — every pair below refers to the same
real-world stadium/city as the local record; changing the stored value would trade one correct
label for another, equally correct, label, and risk losing the tournament-accurate name. Local
stadium `name`/`city` values were deliberately generated to preserve the era-appropriate name
(the prior stadium-generation milestone explicitly kept, e.g., `AWD-Arena` rather than renaming it
to a later sponsor's name) — documented in
[`docs/CONVENTIONS.md`](CONVENTIONS.md#stadium-naming-policy).

<details>
<summary>All 3 pair(s) in this category</summary>

| OpenFootball | FIFA | Matches | Reason |
|---|---|---:|---|
| Luzhniki Stadium | Lenin | 7 | Luzhniki was known as "V. I. Lenin Central Stadium" for most of the Soviet era; FIFA's record still carries that name. |
| Saint Petersburg Stadium | Krestovsky Stadium | 7 | Krestovsky Stadium is the ground's other official name, after Krestovsky Island where it stands. |
| Volgograd Arena | Central Stadium | 4 | Volgograd Arena was built on the site of (and initially traded under) the old Soviet-era "Central Stadium". |

</details>

### City label differences

**Count:** 19 finding(s) across 2 distinct OpenFootball/FIFA naming pair(s).

Example:

OpenFootball:

```text
Al Rayyan
```

FIFA:

```text
Ar-Rayyan
```

Reason:

Transliteration variant of the same Arabic city name.

Action:

No change required.

**Why this warning exists:** Cities are occasionally renamed outright (South Africa's post-apartheid municipal renamings), or the same city name has more than one accepted transliteration into English/Latin script.

**Same physical entity?** Yes - same physical settlement, alternate spelling/transliteration or an official renaming of that same place.

**Should the dataset be changed?** No. No action required — every pair below refers to the same
real-world city as the local record; changing the stored value would trade one correct label for
another, equally correct, label. This naming policy is documented in
[`docs/CONVENTIONS.md`](CONVENTIONS.md#city-naming-policy).

<details>
<summary>All 2 pair(s) in this category</summary>

| OpenFootball | FIFA | Matches | Reason |
|---|---|---:|---|
| Al Rayyan | Ar-Rayyan | 15 | Transliteration variant of the same Arabic city name. |
| Nelspruit | Mbombela | 4 | Nelspruit was officially renamed Mbombela in 2009. |

</details>

### Administrative area differences

**Count:** 39 finding(s) across 7 distinct OpenFootball/FIFA naming pair(s).

Example:

OpenFootball:

```text
Lusail
```

FIFA:

```text
Al Daayen
```

Reason:

Lusail city sits within Al Daayen municipality, which FIFA uses as the location label.

Action:

No change required.

**Why this warning exists:** A stadium's postal town/municipality and its enclosing prefecture/province/metropolitan-municipality are both legitimate ways to describe "where" it is. OpenFootball and FIFA don't consistently pick the same level of that hierarchy.

**Same physical entity?** Yes - same physical location, described at a different administrative level (prefecture/province/metro grouping vs. the specific town/municipality).

**Should the dataset be changed?** No. No action required — every pair below refers to the same
real-world location as the local record, just described at a different administrative level;
changing the stored value would trade one correct label for another, equally correct, label. This
naming policy is documented in [`docs/CONVENTIONS.md`](CONVENTIONS.md#city-naming-policy).

<details>
<summary>All 7 pair(s) in this category</summary>

| OpenFootball | FIFA | Matches | Reason |
|---|---|---:|---|
| Lusail | Al Daayen | 10 | Lusail city sits within Al Daayen municipality, which FIFA uses as the location label. |
| Al Rayyan | Doha | 8 | Al Rayyan is grouped under the greater Doha metropolitan area in FIFA's record. |
| Rustenburg | Phokeng | 6 | Royal Bafokeng Stadium is specifically in Phokeng, a town within Rustenburg local municipality. |
| Bloemfontein | Mangaung | 6 | Bloemfontein sits within Mangaung Metropolitan Municipality, the post-1994 administrative area. |
| Ibaraki | Kashima | 3 | Ibaraki is the prefecture; Kashima is the specific town the stadium is in. |
| Jeju | Seogwipo-si | 3 | Jeju is the island/province; Seogwipo-si is the specific municipality ("-si" = city). |
| Miyagi | Rifu | 3 | Miyagi is the prefecture; Rifu is the specific town the stadium is in. |

</details>

### Other

**Count:** 120 finding(s) across 19 distinct OpenFootball/FIFA naming pair(s).

Example:

OpenFootball:

```text
AT&T Stadium
```

FIFA:

```text
Dallas Stadium
```

Reason:

FIFA's own neutral in-tournament branding policy (2026) - avoids promoting a non-partner sponsor.

Action:

No change required.

**Why this warning exists:** The dominant driver here is FIFA's own policy of using neutral, sponsor-free stadium names in its official competition data and broadcast graphics, specifically to avoid promoting a company that isn't an official FIFA partner (documented practice at the 2006, 2010, and 2026 tournaments). One pair (RheinEnergieStadion / Rhein Energie Stadium) is not a naming difference at all - just spacing.

**Same physical entity?** Yes - same physical stadium in every case. Mostly FIFA's own neutral, sponsor-free in-tournament naming policy (2006/2010/2026), plus one pure spacing/formatting variant.

**Should the dataset be changed?** No. No action required — every pair below refers to the same
real-world stadium/city as the local record; changing the stored value would trade one correct
label for another, equally correct, label, and risk losing the tournament-accurate name. Local
stadium `name`/`city` values were deliberately generated to preserve the era-appropriate name
(the prior stadium-generation milestone explicitly kept, e.g., `AWD-Arena` rather than renaming it
to a later sponsor's name) — documented in
[`docs/CONVENTIONS.md`](CONVENTIONS.md#stadium-naming-policy).

<details>
<summary>All 19 pair(s) in this category</summary>

| OpenFootball | FIFA | Matches | Reason |
|---|---|---:|---|
| AT&T Stadium | Dallas Stadium | 9 | FIFA's own neutral in-tournament branding policy (2026) - avoids promoting a non-partner sponsor. |
| Nelson Mandela Bay Stadium | Port Elizabeth Stadium | 8 | FIFA's own neutral in-tournament branding policy (2010). |
| SoFi Stadium | Los Angeles Stadium | 8 | FIFA's own neutral in-tournament branding policy (2026). |
| Mercedes-Benz Stadium | Atlanta Stadium | 8 | FIFA's own neutral in-tournament branding policy (2026). |
| Moses Mabhida Stadium | Durban Stadium | 7 | FIFA's own neutral in-tournament branding policy (2010). |
| MetLife Stadium | New York/New Jersey Stadium | 7 | FIFA's own neutral in-tournament branding policy (2026). |
| Gillette Stadium | Boston Stadium | 7 | FIFA's own neutral in-tournament branding policy (2026). |
| NRG Stadium | Houston Stadium | 7 | FIFA's own neutral in-tournament branding policy (2026). |
| BMO Field | Toronto Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Levi's Stadium | San Francisco Bay Area Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Lincoln Financial Field | Philadelphia Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Lumen Field | Seattle Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Hard Rock Stadium | Miami Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Arrowhead Stadium | Kansas City Stadium | 6 | FIFA's own neutral in-tournament branding policy (2026). |
| Veltins-Arena | FIFA World Cup Stadium, Gelsenkirchen | 5 | FIFA's own neutral in-tournament branding policy (2006) - the neutral name is literally "FIFA World Cup Stadium". |
| Estadio Azteca | Mexico City Stadium | 5 | FIFA's own neutral in-tournament branding policy (2026). |
| RheinEnergieStadion | Rhein Energie Stadium | 5 | Pure formatting difference - same sponsor (RheinEnergie), spaced differently. Not a rename at all. |
| Estadio Akron | Guadalajara Stadium | 4 | FIFA's own neutral in-tournament branding policy (2026). |
| Estadio BBVA | Monterrey Stadium | 4 | FIFA's own neutral in-tournament branding policy (2026). |

</details>

---

## Per tournament

| Tournament | Audited | Warnings | Errors |
|---|---|---|---|
| 2002 | 64 | 9 | 0 |
| 2006 | 64 | 26 | 0 |
| 2010 | 64 | 31 | 0 |
| 2014 | 64 | 6 | 0 |
| 2018 | 64 | 29 | 0 |
| 2022 | 64 | 33 | 0 |
| 2026 | 102 | 95 | 0 |
| **Total** | **486** | **229** | **0** |

---

## Post-release updates

### 2026-07-15 — `2026-101` score confirmed

The first semi-final (`2026-101`, France v Spain, played 2026-07-14 at AT&T Stadium/"Dallas
Stadium") had a `null` score at the time of the audit above, since it had not yet been played.
It has since been played and re-checked against a freshly-fetched copy of FIFA's competition data
(`api.fifa.com`, match `IdMatch: 400021541`):

| Field | Local value | FIFA value | Match? |
|---|---|---|---|
| `full_time_team_a` / `full_time_team_b` | 0 / 2 | 0 / 2 | Yes |
| `half_time_team_a` / `half_time_team_b` | 0 / 1 | not exposed by FIFA (sourced from OpenFootball, per the documented scope limitation) | N/A |
| `kickoff_at` | `2026-07-14T19:00:00Z` | `2026-07-14T19:00:00Z` | Yes |
| `stadium_id` | AT&T Stadium | "Dallas Stadium" (FIFA's neutral in-tournament branding) | Yes — same physical venue, already covered by the "Other" warning category above |

Zero discrepancies. `2026-102` (second semi-final), the third-place play-off (`2026-103`), and the
final (`2026-104`) remain unplayed/unresolved as of this update.

### 2026-07-15 — `2026-102` score confirmed

The second semi-final (`2026-102`, England v Argentina, played 2026-07-15 at Mercedes-Benz
Stadium/"Atlanta Stadium") had a `null` score at the time of the audit above, since it had not yet
been played. It has since been played and re-checked against a freshly-fetched copy of FIFA's
competition data (`api.fifa.com`, match `IdMatch: 400021540`):

| Field | Local value | FIFA value | Match? |
|---|---|---|---|
| `full_time_team_a` / `full_time_team_b` | 1 / 2 | 1 / 2 | Yes |
| `half_time_team_a` / `half_time_team_b` | 0 / 0 | not exposed by FIFA (sourced from OpenFootball, per the documented scope limitation) | N/A |
| `kickoff_at` | `2026-07-15T19:00:00Z` | `2026-07-15T19:00:00Z` | Yes |
| `stadium_id` | Mercedes-Benz Stadium | "Atlanta Stadium" (FIFA's neutral in-tournament branding) | Yes — same physical venue, already covered by the "Other" warning category above |

Zero discrepancies. Both semi-finals are now confirmed. The third-place play-off (`2026-103`,
France v England, 2026-07-18) and the final (`2026-104`, Spain v Argentina, 2026-07-19) now have
known participants per FIFA but remain absent from `data/matches/2026.json` pending kickoff/result.

### 2026-07-18 — `2026-103` added

The third-place play-off (`2026-103`, France v England, played 2026-07-18 at Hard Rock
Stadium/"Miami Stadium") was previously absent from `data/matches/2026.json` entirely (not just
`null`-scored), since its participants were only determined once both semi-finals concluded. It
has now been played; a new match record was added, sourced from OpenFootball (`2026/worldcup.json`,
match `num: 103`) per the project's standard field-sourcing policy, and cross-checked against a
freshly-fetched copy of FIFA's competition data (`api.fifa.com`, match `IdMatch: 400021542`):

| Field | Local value | OpenFootball value | FIFA value | Match? |
|---|---|---|---|---|
| `team_a_id` / `team_b_id` | France / England | `team1: France` / `team2: England` | HomeTeam France / AwayTeam England | Yes |
| `full_time_team_a` / `full_time_team_b` | 4 / 6 | `score.ft: [4, 6]` | 4 / 6 | Yes |
| `half_time_team_a` / `half_time_team_b` | 0 / 4 | `score.ht: [0, 4]` | not exposed by FIFA (kickoff/audit role only, per [DATA_SOURCES.md](DATA_SOURCES.md)) | Yes |
| `extra_time_team_a` / `extra_time_team_b` | `null` / `null` | no `score.et` key present (unlike matches `99`/`100`, which do carry one) | `ResultType: 1` (normal time) and both `HomeTeamPenaltyScore`/`AwayTeamPenaltyScore` null | Yes |
| `kickoff_at` | `2026-07-18T21:00:00Z` | `2026-07-18` `17:00 UTC-4` (local) | `2026-07-18T21:00:00Z` | Yes — FIFA is authoritative for `kickoff_at`; OpenFootball's local time converts to the same instant |
| `stadium_id` | Hard Rock Stadium | `ground: "Miami (Miami Gardens)"` | "Miami Stadium" (FIFA's neutral in-tournament branding) | Yes — same physical venue, already covered by the "Other" warning category above |

Note: some secondary press recaps (referencing the England match-winner's "98th minute" goal)
loosely described this match as having gone to extra time; that framing is not used here since it
does not come from one of this project's three sourcing tiers. Both OpenFootball (no `score.et` key)
and FIFA (`ResultType: 1`, null penalty fields) independently confirm this was a normal-time result
— the goal sequence (last goal at 90+8') fits entirely within normal time plus
second-half stoppage. Treated as a normal-time result; `extra_time_team_a`/`_b` and
`penalties_team_a`/`_b` all remain `null`.

Zero discrepancies. `tests/fixtures/fifa_kickoffs.json` was updated with the corresponding
`2026-103` entry. The final (`2026-104`, Spain v Argentina, 2026-07-19) remains pending.

## Missing data

### Present in FIFA but missing locally

| Code | Home | Away | Stage | FIFA date |
|---|---|---|---|---|
| `2026-104` | TBD | TBD | Final | 2026-07-19T19:00:00Z |

Still a 2026 knockout match not yet played as of this update (the final): both OpenFootball and
FIFA still carry unresolved placeholder team references for it, so no real team can be assigned
without guessing. This is a documented, deliberate exclusion.

### Present locally but missing in FIFA

None. Every one of the 486 local matches resolved to exactly one FIFA fixture.

---

## Recommendations

| Warning category | Recommendation |
|---|---|
| Stadium branding differences | No action required |
| Historical stadium names | No action required |
| City label differences | No action required |
| Administrative area differences | No action required |
| Other | No action required |

No warning category is classified as a data error. None require a schema or value change to
`data/matches/`, `data/stadiums.json`, or `data/countries.json`. An optional, non-blocking idea for a
future schema version: capture FIFA's alternate/neutral stadium name and city label as supplementary
metadata (e.g. `fifa_name`, `fifa_city`) on `stadiums.json`, purely for cross-reference — not because
today's values are wrong.

---

## Final conclusion

**1. Are there any remaining confirmed data integrity issues?**

No. Zero confirmed errors. The one previously-confirmed error (`2022-046`, wrong stadium) was fixed
and re-verified against a freshly-fetched copy of FIFA's data in the prior milestone.

**2. Are all remaining warnings purely metadata differences?**

Yes. All 229 warnings were individually traced to one of five well-understood causes
(sponsor-name succession, historical/traditional naming, city renaming or transliteration, differing
administrative granularity, or FIFA's own neutral in-tournament branding policy plus one formatting
quirk). In every single case the underlying physical stadium and city are identical between
OpenFootball and FIFA — none represent a wrong team, wrong score, wrong date, wrong stage, or wrong
venue.

**3. Is the dataset suitable for a stable v1.0.0 release?**

Yes.

**4. Would you personally recommend any further data corrections before release?**

No corrections are required before release. The dataset is release-ready as-is. This naming policy —
stadium `name`/`city` values intentionally preserve the era-appropriate/tournament-time name rather
than tracking sponsor changes or FIFA's neutral broadcast naming — is now documented in
[`docs/CONVENTIONS.md`](CONVENTIONS.md#stadium-naming-policy), so future contributors don't mistake
these warnings for bugs and "fix" them into a worse state.

### Final assessment: PASS WITH WARNINGS (warnings are informational only — release-ready)

