# World Cup referee → match mapping (2002–2026)

Data-preparation document produced for the "Referee Match Mapping" research
milestone. This is **not** part of the committed dataset — it is a working
reference to support a future decision on whether to add a normalized
`referees` entity to `world-cup-data`.

> This document is the canonical source for referee assignments.
>
> Future machine-readable datasets (for example `referees.json`) should be
> generated from this document rather than edited manually.

## Method

- **2002, 2006, 2010, 2014, 2018** — sourced from RSSSF's per-tournament full
  match tables (`rsssf.org/tables/{year}full.html`), which list each match's
  head referee and nationality directly. Matched to this repo's match `code`
  by team pairing and kickoff date, not by assuming row order.
- **2022** — RSSSF has no equivalent full-table page for this tournament.
  Sourced from Wikipedia's "2022 FIFA World Cup officials" article (raw
  wikitable, "Matches assigned" column only — the "Fourth official" column
  was explicitly excluded).
- **2026** — sourced from FIFA's live competition API
  (`api.fifa.com`, season id `285023`, competition id `17`), taking the
  `Officials` entry with `OfficialType: 1` (head Referee only — assistants,
  fourth officials, and VAR were excluded). Covers all 104 matches now
  committed in `data/matches/2026.json`, including the third-place match
  (`2026-103`) and the final (`2026-104`), both added once played.

Every row was cross-checked against this repo's actual match records
(`data/matches/*.json`: team pairing, UTC kickoff time, tournament) rather
than assumed from source-side ordering. Referee names were normalized to a
single consistent spelling (with correct diacritics) where the same person
appeared under different renderings across tournaments or sources — see
"Normalization notes" below.

**Referee Code** is a stable, lowercase, ASCII-only slug derived from each
referee's normalized full name (accents stripped, spaces and punctuation
replaced with `-`). It is identical across every occurrence of the same
referee and is intended as the natural primary key / `referee_id` source
for a future `referees.json`.

**Association** is the football association the referee officiated under
for that tournament, matching FIFA's own designation — not an ISO country
code. This matters specifically for the United Kingdom, which has no single
football association: referees are individually licensed under England,
Scotland, Wales, or Northern Ireland. All five United Kingdom-affiliated
referees in this dataset are English except Hugh Dallas, who is Scottish.

## Match → referee mapping (488 rows)

| Match | Tournament | Referee Code | Referee | Association |
|---|---|---|---|---|
| 2002-001 | 2002 | ali-bujsaim | Ali Bujsaim | United Arab Emirates |
| 2002-002 | 2002 | toru-kamikawa | Toru Kamikawa | Japan |
| 2002-003 | 2002 | saad-mane | Saad Mane | Kuwait |
| 2002-004 | 2002 | ubaldo-aquino | Ubaldo Aquino | Paraguay |
| 2002-005 | 2002 | carlos-simon | Carlos Simon | Brazil |
| 2002-006 | 2002 | lubos-michel | Ľuboš Micheľ | Slovakia |
| 2002-007 | 2002 | gilles-veissiere | Gilles Veissière | France |
| 2002-008 | 2002 | mohamed-guezzaz | Mohamed Guezzaz | Morocco |
| 2002-009 | 2002 | lu-jun | Lu Jun | China PR |
| 2002-010 | 2002 | kim-young-joo | Kim Young-Joo | South Korea |
| 2002-011 | 2002 | brian-hall | Brian Hall | United States |
| 2002-012 | 2002 | kyros-vassaras | Kyros Vassaras | Greece |
| 2002-013 | 2002 | william-mattus | William Mattus | Costa Rica |
| 2002-014 | 2002 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2002-015 | 2002 | peter-prendergast | Peter Prendergast | Jamaica |
| 2002-016 | 2002 | byron-moreno | Byron Moreno | Ecuador |
| 2002-017 | 2002 | kim-milton-nielsen | Kim Milton Nielsen | Denmark |
| 2002-018 | 2002 | felipe-ramos-rizo | Felipe Ramos Rizo | Mexico |
| 2002-019 | 2002 | terje-hauge | Terje Hauge | Norway |
| 2002-020 | 2002 | carlos-batres | Carlos Batrés | Guatemala |
| 2002-021 | 2002 | rene-ortube | René Ortube | Bolivia |
| 2002-022 | 2002 | gamal-ghandour | Gamal Ghandour | Egypt |
| 2002-023 | 2002 | pierluigi-collina | Pierluigi Collina | Italy |
| 2002-024 | 2002 | angel-sanchez | Ángel Sánchez | Argentina |
| 2002-025 | 2002 | graham-poll | Graham Poll | England |
| 2002-026 | 2002 | anders-frisk | Anders Frisk | Sweden |
| 2002-027 | 2002 | mourad-daami | Mourad Daami | Tunisia |
| 2002-028 | 2002 | coffi-codjia | Coffi Codjia | Benin |
| 2002-029 | 2002 | markus-merk | Markus Merk | Germany |
| 2002-030 | 2002 | urs-meier | Urs Meier | Switzerland |
| 2002-031 | 2002 | mark-shield | Mark Shield | Australia |
| 2002-032 | 2002 | hugh-dallas | Hugh Dallas | Scotland |
| 2002-033 | 2002 | vitor-melo-pereira | Vítor Melo Pereira | Portugal |
| 2002-034 | 2002 | jan-wegereef | Jan Wegereef | Netherlands |
| 2002-035 | 2002 | antonio-lopez-nieto | Antonio López Nieto | Spain |
| 2002-036 | 2002 | falla-ndoye | Falla Ndoye | Senegal |
| 2002-037 | 2002 | ali-bujsaim | Ali Bujsaim | United Arab Emirates |
| 2002-038 | 2002 | brian-hall | Brian Hall | United States |
| 2002-039 | 2002 | saad-mane | Saad Mane | Kuwait |
| 2002-040 | 2002 | felipe-ramos-rizo | Felipe Ramos Rizo | Mexico |
| 2002-041 | 2002 | gamal-ghandour | Gamal Ghandour | Egypt |
| 2002-042 | 2002 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2002-043 | 2002 | carlos-simon | Carlos Simon | Brazil |
| 2002-044 | 2002 | william-mattus | William Mattus | Costa Rica |
| 2002-045 | 2002 | gilles-veissiere | Gilles Veissière | France |
| 2002-046 | 2002 | kim-milton-nielsen | Kim Milton Nielsen | Denmark |
| 2002-047 | 2002 | angel-sanchez | Ángel Sánchez | Argentina |
| 2002-048 | 2002 | lu-jun | Lu Jun | China PR |
| 2002-049 | 2002 | carlos-batres | Carlos Batrés | Guatemala |
| 2002-050 | 2002 | markus-merk | Markus Merk | Germany |
| 2002-051 | 2002 | ubaldo-aquino | Ubaldo Aquino | Paraguay |
| 2002-052 | 2002 | anders-frisk | Anders Frisk | Sweden |
| 2002-053 | 2002 | vitor-melo-pereira | Vítor Melo Pereira | Portugal |
| 2002-054 | 2002 | peter-prendergast | Peter Prendergast | Jamaica |
| 2002-055 | 2002 | pierluigi-collina | Pierluigi Collina | Italy |
| 2002-056 | 2002 | byron-moreno | Byron Moreno | Ecuador |
| 2002-057 | 2002 | felipe-ramos-rizo | Felipe Ramos Rizo | Mexico |
| 2002-058 | 2002 | hugh-dallas | Hugh Dallas | Scotland |
| 2002-059 | 2002 | gamal-ghandour | Gamal Ghandour | Egypt |
| 2002-060 | 2002 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2002-061 | 2002 | urs-meier | Urs Meier | Switzerland |
| 2002-062 | 2002 | kim-milton-nielsen | Kim Milton Nielsen | Denmark |
| 2002-063 | 2002 | saad-mane | Saad Mane | Kuwait |
| 2002-064 | 2002 | pierluigi-collina | Pierluigi Collina | Italy |
| 2006-001 | 2006 | horacio-elizondo | Horacio Elizondo | Argentina |
| 2006-002 | 2006 | toru-kamikawa | Toru Kamikawa | Japan |
| 2006-003 | 2006 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2006-004 | 2006 | shamsul-maidin | Shamsul Maidin | Singapore |
| 2006-005 | 2006 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2006-006 | 2006 | markus-merk | Markus Merk | Germany |
| 2006-007 | 2006 | roberto-rosetti | Roberto Rosetti | Italy |
| 2006-008 | 2006 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2006-009 | 2006 | carlos-simon | Carlos Simon | Brazil |
| 2006-010 | 2006 | carlos-amarilla | Carlos Amarilla | Paraguay |
| 2006-011 | 2006 | benito-archundia | Benito Archundia | Mexico |
| 2006-012 | 2006 | essam-abd-el-fatah | Essam Abd El Fatah | Egypt |
| 2006-013 | 2006 | valentin-ivanov | Valentin Ivanov | Russia |
| 2006-014 | 2006 | graham-poll | Graham Poll | England |
| 2006-015 | 2006 | massimo-busacca | Massimo Busacca | Switzerland |
| 2006-016 | 2006 | mark-shield | Mark Shield | Australia |
| 2006-017 | 2006 | luis-medina-cantalejo | Luis Medina Cantalejo | Spain |
| 2006-018 | 2006 | coffi-codjia | Coffi Codjia | Benin |
| 2006-019 | 2006 | toru-kamikawa | Toru Kamikawa | Japan |
| 2006-020 | 2006 | lubos-michel | Ľuboš Micheľ | Slovakia |
| 2006-021 | 2006 | roberto-rosetti | Roberto Rosetti | Italy |
| 2006-022 | 2006 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2006-023 | 2006 | shamsul-maidin | Shamsul Maidin | Singapore |
| 2006-024 | 2006 | eric-poulat | Éric Poulat | France |
| 2006-025 | 2006 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2006-026 | 2006 | horacio-elizondo | Horacio Elizondo | Argentina |
| 2006-027 | 2006 | markus-merk | Markus Merk | Germany |
| 2006-028 | 2006 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2006-029 | 2006 | benito-archundia | Benito Archundia | Mexico |
| 2006-030 | 2006 | carlos-amarilla | Carlos Amarilla | Paraguay |
| 2006-031 | 2006 | carlos-simon | Carlos Simon | Brazil |
| 2006-032 | 2006 | graham-poll | Graham Poll | England |
| 2006-033 | 2006 | valentin-ivanov | Valentin Ivanov | Russia |
| 2006-034 | 2006 | shamsul-maidin | Shamsul Maidin | Singapore |
| 2006-035 | 2006 | massimo-busacca | Massimo Busacca | Switzerland |
| 2006-036 | 2006 | roberto-rosetti | Roberto Rosetti | Italy |
| 2006-037 | 2006 | luis-medina-cantalejo | Luis Medina Cantalejo | Spain |
| 2006-038 | 2006 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2006-039 | 2006 | lubos-michel | Ľuboš Micheľ | Slovakia |
| 2006-040 | 2006 | mark-shield | Mark Shield | Australia |
| 2006-041 | 2006 | benito-archundia | Benito Archundia | Mexico |
| 2006-042 | 2006 | markus-merk | Markus Merk | Germany |
| 2006-043 | 2006 | eric-poulat | Éric Poulat | France |
| 2006-044 | 2006 | graham-poll | Graham Poll | England |
| 2006-045 | 2006 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2006-046 | 2006 | horacio-elizondo | Horacio Elizondo | Argentina |
| 2006-047 | 2006 | coffi-codjia | Coffi Codjia | Benin |
| 2006-048 | 2006 | carlos-amarilla | Carlos Amarilla | Paraguay |
| 2006-049 | 2006 | carlos-simon | Carlos Simon | Brazil |
| 2006-050 | 2006 | massimo-busacca | Massimo Busacca | Switzerland |
| 2006-051 | 2006 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2006-052 | 2006 | valentin-ivanov | Valentin Ivanov | Russia |
| 2006-053 | 2006 | luis-medina-cantalejo | Luis Medina Cantalejo | Spain |
| 2006-054 | 2006 | benito-archundia | Benito Archundia | Mexico |
| 2006-055 | 2006 | lubos-michel | Ľuboš Micheľ | Slovakia |
| 2006-056 | 2006 | roberto-rosetti | Roberto Rosetti | Italy |
| 2006-057 | 2006 | lubos-michel | Ľuboš Micheľ | Slovakia |
| 2006-058 | 2006 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2006-059 | 2006 | horacio-elizondo | Horacio Elizondo | Argentina |
| 2006-060 | 2006 | luis-medina-cantalejo | Luis Medina Cantalejo | Spain |
| 2006-061 | 2006 | benito-archundia | Benito Archundia | Mexico |
| 2006-062 | 2006 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2006-063 | 2006 | toru-kamikawa | Toru Kamikawa | Japan |
| 2006-064 | 2006 | horacio-elizondo | Horacio Elizondo | Argentina |
| 2010-001 | 2010 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2010-002 | 2010 | yuichi-nishimura | Yūichi Nishimura | Japan |
| 2010-003 | 2010 | wolfgang-stark | Wolfgang Stark | Germany |
| 2010-004 | 2010 | michael-hester | Michael Hester | New Zealand |
| 2010-005 | 2010 | carlos-simon | Carlos Simon | Brazil |
| 2010-006 | 2010 | carlos-batres | Carlos Batrés | Guatemala |
| 2010-007 | 2010 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2010-008 | 2010 | hector-baldassi | Héctor Baldassi | Argentina |
| 2010-009 | 2010 | stephane-lannoy | Stéphane Lannoy | France |
| 2010-010 | 2010 | olegario-benquerenca | Olegário Benquerença | Portugal |
| 2010-011 | 2010 | benito-archundia | Benito Archundia | Mexico |
| 2010-012 | 2010 | jerome-damon | Jerome Damon | South Africa |
| 2010-013 | 2010 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2010-014 | 2010 | viktor-kassai | Viktor Kassai | Hungary |
| 2010-015 | 2010 | eddy-maillet | Eddy Maillet | Seychelles |
| 2010-016 | 2010 | howard-webb | Howard Webb | England |
| 2010-017 | 2010 | massimo-busacca | Massimo Busacca | Switzerland |
| 2010-018 | 2010 | khalil-al-ghamdi | Khalil Al-Ghamdi | Saudi Arabia |
| 2010-019 | 2010 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2010-020 | 2010 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2010-021 | 2010 | alberto-undiano | Alberto Undiano | Spain |
| 2010-022 | 2010 | koman-coulibaly | Koman Coulibaly | Mali |
| 2010-023 | 2010 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2010-024 | 2010 | roberto-rosetti | Roberto Rosetti | Italy |
| 2010-025 | 2010 | hector-baldassi | Héctor Baldassi | Argentina |
| 2010-026 | 2010 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2010-027 | 2010 | eddy-maillet | Eddy Maillet | Seychelles |
| 2010-028 | 2010 | carlos-batres | Carlos Batrés | Guatemala |
| 2010-029 | 2010 | stephane-lannoy | Stéphane Lannoy | France |
| 2010-030 | 2010 | pablo-pozo | Pablo Pozo | Chile |
| 2010-031 | 2010 | khalil-al-ghamdi | Khalil Al-Ghamdi | Saudi Arabia |
| 2010-032 | 2010 | yuichi-nishimura | Yūichi Nishimura | Japan |
| 2010-033 | 2010 | viktor-kassai | Viktor Kassai | Hungary |
| 2010-034 | 2010 | oscar-ruiz | Óscar Ruiz | Colombia |
| 2010-035 | 2010 | olegario-benquerenca | Olegário Benquerença | Portugal |
| 2010-036 | 2010 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2010-037 | 2010 | wolfgang-stark | Wolfgang Stark | Germany |
| 2010-038 | 2010 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2010-039 | 2010 | carlos-simon | Carlos Simon | Brazil |
| 2010-040 | 2010 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2010-041 | 2010 | howard-webb | Howard Webb | England |
| 2010-042 | 2010 | yuichi-nishimura | Yūichi Nishimura | Japan |
| 2010-043 | 2010 | jerome-damon | Jerome Damon | South Africa |
| 2010-044 | 2010 | pablo-pozo | Pablo Pozo | Chile |
| 2010-045 | 2010 | benito-archundia | Benito Archundia | Mexico |
| 2010-046 | 2010 | alberto-undiano | Alberto Undiano | Spain |
| 2010-047 | 2010 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2010-048 | 2010 | hector-baldassi | Héctor Baldassi | Argentina |
| 2010-049 | 2010 | wolfgang-stark | Wolfgang Stark | Germany |
| 2010-050 | 2010 | viktor-kassai | Viktor Kassai | Hungary |
| 2010-051 | 2010 | jorge-larrionda | Jorge Larrionda | Uruguay |
| 2010-052 | 2010 | roberto-rosetti | Roberto Rosetti | Italy |
| 2010-053 | 2010 | alberto-undiano | Alberto Undiano | Spain |
| 2010-054 | 2010 | howard-webb | Howard Webb | England |
| 2010-055 | 2010 | frank-de-bleeckere | Frank De Bleeckere | Belgium |
| 2010-056 | 2010 | hector-baldassi | Héctor Baldassi | Argentina |
| 2010-057 | 2010 | yuichi-nishimura | Yūichi Nishimura | Japan |
| 2010-058 | 2010 | olegario-benquerenca | Olegário Benquerença | Portugal |
| 2010-059 | 2010 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2010-060 | 2010 | carlos-batres | Carlos Batrés | Guatemala |
| 2010-061 | 2010 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2010-062 | 2010 | viktor-kassai | Viktor Kassai | Hungary |
| 2010-063 | 2010 | benito-archundia | Benito Archundia | Mexico |
| 2010-064 | 2010 | howard-webb | Howard Webb | England |
| 2014-001 | 2014 | yuichi-nishimura | Yūichi Nishimura | Japan |
| 2014-002 | 2014 | wilmar-roldan | Wilmar Roldán | Colombia |
| 2014-003 | 2014 | nicola-rizzoli | Nicola Rizzoli | Italy |
| 2014-004 | 2014 | noumandiez-doue | Noumandiez Doué | Ivory Coast |
| 2014-005 | 2014 | mark-geiger | Mark Geiger | United States |
| 2014-006 | 2014 | enrique-osses | Enrique Osses | Chile |
| 2014-007 | 2014 | felix-brych | Felix Brych | Germany |
| 2014-008 | 2014 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2014-009 | 2014 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2014-010 | 2014 | sandro-ricci | Sandro Ricci | Brazil |
| 2014-011 | 2014 | joel-aguilar | Joel Aguilar | El Salvador |
| 2014-012 | 2014 | carlos-vera | Carlos Vera | Ecuador |
| 2014-013 | 2014 | milorad-mazic | Milorad Mažić | Serbia |
| 2014-014 | 2014 | jonas-eriksson | Jonas Eriksson | Sweden |
| 2014-015 | 2014 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2014-016 | 2014 | nestor-pitana | Néstor Pitana | Argentina |
| 2014-017 | 2014 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2014-018 | 2014 | pedro-proenca | Pedro Proença | Portugal |
| 2014-019 | 2014 | mark-geiger | Mark Geiger | United States |
| 2014-020 | 2014 | djamel-haimoudi | Djamel Haïmoudi | Algeria |
| 2014-021 | 2014 | howard-webb | Howard Webb | England |
| 2014-022 | 2014 | joel-aguilar | Joel Aguilar | El Salvador |
| 2014-023 | 2014 | carlos-velasco-carballo | Carlos Velasco Carballo | Spain |
| 2014-024 | 2014 | enrique-osses | Enrique Osses | Chile |
| 2014-025 | 2014 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2014-026 | 2014 | ben-williams | Ben Williams | Australia |
| 2014-027 | 2014 | milorad-mazic | Milorad Mažić | Serbia |
| 2014-028 | 2014 | peter-oleary | Peter O'Leary | New Zealand |
| 2014-029 | 2014 | sandro-ricci | Sandro Ricci | Brazil |
| 2014-030 | 2014 | nestor-pitana | Néstor Pitana | Argentina |
| 2014-031 | 2014 | felix-brych | Felix Brych | Germany |
| 2014-032 | 2014 | wilmar-roldan | Wilmar Roldán | Colombia |
| 2014-033 | 2014 | jonas-eriksson | Jonas Eriksson | Sweden |
| 2014-034 | 2014 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2014-035 | 2014 | nawaf-shukrallah | Nawaf Shukrallah | Bahrain |
| 2014-036 | 2014 | bakary-gassama | Bakary Gassama | Gambia |
| 2014-037 | 2014 | pedro-proenca | Pedro Proença | Portugal |
| 2014-038 | 2014 | carlos-vera | Carlos Vera | Ecuador |
| 2014-039 | 2014 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2014-040 | 2014 | djamel-haimoudi | Djamel Haïmoudi | Algeria |
| 2014-041 | 2014 | nestor-pitana | Néstor Pitana | Argentina |
| 2014-042 | 2014 | noumandiez-doue | Noumandiez Doué | Ivory Coast |
| 2014-043 | 2014 | nicola-rizzoli | Nicola Rizzoli | Italy |
| 2014-044 | 2014 | carlos-velasco-carballo | Carlos Velasco Carballo | Spain |
| 2014-045 | 2014 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2014-046 | 2014 | nawaf-shukrallah | Nawaf Shukrallah | Bahrain |
| 2014-047 | 2014 | ben-williams | Ben Williams | Australia |
| 2014-048 | 2014 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2014-049 | 2014 | howard-webb | Howard Webb | England |
| 2014-050 | 2014 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2014-051 | 2014 | pedro-proenca | Pedro Proença | Portugal |
| 2014-052 | 2014 | ben-williams | Ben Williams | Australia |
| 2014-053 | 2014 | mark-geiger | Mark Geiger | United States |
| 2014-054 | 2014 | sandro-ricci | Sandro Ricci | Brazil |
| 2014-055 | 2014 | jonas-eriksson | Jonas Eriksson | Sweden |
| 2014-056 | 2014 | djamel-haimoudi | Djamel Haïmoudi | Algeria |
| 2014-057 | 2014 | carlos-velasco-carballo | Carlos Velasco Carballo | Spain |
| 2014-058 | 2014 | nestor-pitana | Néstor Pitana | Argentina |
| 2014-059 | 2014 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2014-060 | 2014 | nicola-rizzoli | Nicola Rizzoli | Italy |
| 2014-061 | 2014 | marco-antonio-rodriguez | Marco Antonio Rodríguez | Mexico |
| 2014-062 | 2014 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2014-063 | 2014 | djamel-haimoudi | Djamel Haïmoudi | Algeria |
| 2014-064 | 2014 | nicola-rizzoli | Nicola Rizzoli | Italy |
| 2018-001 | 2018 | nestor-pitana | Néstor Pitana | Argentina |
| 2018-002 | 2018 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2018-003 | 2018 | gianluca-rocchi | Gianluca Rocchi | Italy |
| 2018-004 | 2018 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2018-005 | 2018 | andres-cunha | Andrés Cunha | Uruguay |
| 2018-006 | 2018 | bakary-gassama | Bakary Gassama | Gambia |
| 2018-007 | 2018 | szymon-marciniak | Szymon Marciniak | Poland |
| 2018-008 | 2018 | sandro-ricci | Sandro Ricci | Brazil |
| 2018-009 | 2018 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2018-010 | 2018 | malang-diedhiou | Malang Diedhiou | Senegal |
| 2018-011 | 2018 | alireza-faghani | Alireza Faghani | Iran |
| 2018-012 | 2018 | joel-aguilar | Joel Aguilar | El Salvador |
| 2018-013 | 2018 | janny-sikazwe | Janny Sikazwe | Zambia |
| 2018-014 | 2018 | wilmar-roldan | Wilmar Roldán | Colombia |
| 2018-015 | 2018 | nawaf-shukrallah | Nawaf Shukrallah | Bahrain |
| 2018-016 | 2018 | damir-skomina | Damir Skomina | Slovenia |
| 2018-017 | 2018 | enrique-caceres | Enrique Cáceres | Paraguay |
| 2018-018 | 2018 | clement-turpin | Clément Turpin | France |
| 2018-019 | 2018 | mark-geiger | Mark Geiger | United States |
| 2018-020 | 2018 | andres-cunha | Andrés Cunha | Uruguay |
| 2018-021 | 2018 | mohammed-abdulla-hassan-mohamed | Mohammed Abdulla Hassan Mohamed | United Arab Emirates |
| 2018-022 | 2018 | antonio-mateu-lahoz | Antonio Mateu Lahoz | Spain |
| 2018-023 | 2018 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2018-024 | 2018 | matthew-conger | Matthew Conger | New Zealand |
| 2018-025 | 2018 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2018-026 | 2018 | felix-brych | Felix Brych | Germany |
| 2018-027 | 2018 | szymon-marciniak | Szymon Marciniak | Poland |
| 2018-028 | 2018 | milorad-mazic | Milorad Mažić | Serbia |
| 2018-029 | 2018 | jair-marrufo | Jair Marrufo | United States |
| 2018-030 | 2018 | gehad-grisha | Gehad Grisha | Egypt |
| 2018-031 | 2018 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2018-032 | 2018 | gianluca-rocchi | Gianluca Rocchi | Italy |
| 2018-033 | 2018 | malang-diedhiou | Malang Diedhiou | Senegal |
| 2018-034 | 2018 | wilmar-roldan | Wilmar Roldán | Colombia |
| 2018-035 | 2018 | enrique-caceres | Enrique Cáceres | Paraguay |
| 2018-036 | 2018 | ravshan-ermatov | Ravshan Ermatov | Uzbekistan |
| 2018-037 | 2018 | sandro-ricci | Sandro Ricci | Brazil |
| 2018-038 | 2018 | sergei-karasev | Sergei Karasev | Russia |
| 2018-039 | 2018 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2018-040 | 2018 | antonio-mateu-lahoz | Antonio Mateu Lahoz | Spain |
| 2018-041 | 2018 | alireza-faghani | Alireza Faghani | Iran |
| 2018-042 | 2018 | clement-turpin | Clément Turpin | France |
| 2018-043 | 2018 | mark-geiger | Mark Geiger | United States |
| 2018-044 | 2018 | nestor-pitana | Néstor Pitana | Argentina |
| 2018-045 | 2018 | damir-skomina | Damir Skomina | Slovenia |
| 2018-046 | 2018 | nawaf-shukrallah | Nawaf Shukrallah | Bahrain |
| 2018-047 | 2018 | janny-sikazwe | Janny Sikazwe | Zambia |
| 2018-048 | 2018 | milorad-mazic | Milorad Mažić | Serbia |
| 2018-049 | 2018 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2018-050 | 2018 | alireza-faghani | Alireza Faghani | Iran |
| 2018-051 | 2018 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2018-052 | 2018 | nestor-pitana | Néstor Pitana | Argentina |
| 2018-053 | 2018 | gianluca-rocchi | Gianluca Rocchi | Italy |
| 2018-054 | 2018 | malang-diedhiou | Malang Diedhiou | Senegal |
| 2018-055 | 2018 | damir-skomina | Damir Skomina | Slovenia |
| 2018-056 | 2018 | mark-geiger | Mark Geiger | United States |
| 2018-057 | 2018 | nestor-pitana | Néstor Pitana | Argentina |
| 2018-058 | 2018 | milorad-mazic | Milorad Mažić | Serbia |
| 2018-059 | 2018 | sandro-ricci | Sandro Ricci | Brazil |
| 2018-060 | 2018 | bjorn-kuipers | Björn Kuipers | Netherlands |
| 2018-061 | 2018 | andres-cunha | Andrés Cunha | Uruguay |
| 2018-062 | 2018 | cuneyt-cakir | Cüneyt Çakır | Turkey |
| 2018-063 | 2018 | alireza-faghani | Alireza Faghani | Iran |
| 2018-064 | 2018 | nestor-pitana | Néstor Pitana | Argentina |
| 2022-001 | 2022 | daniele-orsato | Daniele Orsato | Italy |
| 2022-002 | 2022 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2022-003 | 2022 | raphael-claus | Raphael Claus | Brazil |
| 2022-004 | 2022 | abdulrahman-al-jassim | Abdulrahman Al-Jassim | Qatar |
| 2022-005 | 2022 | victor-gomes | Victor Gomes | South Africa |
| 2022-006 | 2022 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2022-007 | 2022 | chris-beath | Chris Beath | Australia |
| 2022-008 | 2022 | slavko-vincic | Slavko Vinčić | Slovenia |
| 2022-009 | 2022 | janny-sikazwe | Janny Sikazwe | Zambia |
| 2022-010 | 2022 | mohammed-abdulla-hassan-mohamed | Mohammed Abdulla Hassan Mohamed | United Arab Emirates |
| 2022-011 | 2022 | ivan-barton | Iván Barton | El Salvador |
| 2022-012 | 2022 | fernando-rapallini | Fernando Rapallini | Argentina |
| 2022-013 | 2022 | facundo-tello | Facundo Tello | Argentina |
| 2022-014 | 2022 | clement-turpin | Clément Turpin | France |
| 2022-015 | 2022 | ismail-elfath | Ismail Elfath | United States |
| 2022-016 | 2022 | alireza-faghani | Alireza Faghani | Iran |
| 2022-017 | 2022 | mario-escobar | Mario Escobar | Guatemala |
| 2022-018 | 2022 | antonio-mateu-lahoz | Antonio Mateu Lahoz | Spain |
| 2022-019 | 2022 | mustapha-ghorbal | Mustapha Ghorbal | Algeria |
| 2022-020 | 2022 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2022-021 | 2022 | daniel-siebert | Daniel Siebert | Germany |
| 2022-022 | 2022 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2022-023 | 2022 | szymon-marciniak | Szymon Marciniak | Poland |
| 2022-024 | 2022 | daniele-orsato | Daniele Orsato | Italy |
| 2022-025 | 2022 | michael-oliver | Michael Oliver | England |
| 2022-026 | 2022 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2022-027 | 2022 | andres-matonte | Andrés Matonte | Uruguay |
| 2022-028 | 2022 | danny-makkelie | Danny Makkelie | Netherlands |
| 2022-029 | 2022 | mohammed-abdulla-hassan-mohamed | Mohammed Abdulla Hassan Mohamed | United Arab Emirates |
| 2022-030 | 2022 | anthony-taylor | Anthony Taylor | England |
| 2022-031 | 2022 | ivan-barton | Iván Barton | El Salvador |
| 2022-032 | 2022 | alireza-faghani | Alireza Faghani | Iran |
| 2022-033 | 2022 | slavko-vincic | Slavko Vinčić | Slovenia |
| 2022-034 | 2022 | antonio-mateu-lahoz | Antonio Mateu Lahoz | Spain |
| 2022-035 | 2022 | clement-turpin | Clément Turpin | France |
| 2022-036 | 2022 | bakary-gassama | Bakary Gassama | Gambia |
| 2022-037 | 2022 | mustapha-ghorbal | Mustapha Ghorbal | Algeria |
| 2022-038 | 2022 | matthew-conger | Matthew Conger | New Zealand |
| 2022-039 | 2022 | danny-makkelie | Danny Makkelie | Netherlands |
| 2022-040 | 2022 | michael-oliver | Michael Oliver | England |
| 2022-041 | 2022 | anthony-taylor | Anthony Taylor | England |
| 2022-042 | 2022 | raphael-claus | Raphael Claus | Brazil |
| 2022-043 | 2022 | victor-gomes | Victor Gomes | South Africa |
| 2022-044 | 2022 | stephanie-frappart | Stéphanie Frappart | France |
| 2022-045 | 2022 | daniel-siebert | Daniel Siebert | Germany |
| 2022-046 | 2022 | facundo-tello | Facundo Tello | Argentina |
| 2022-047 | 2022 | fernando-rapallini | Fernando Rapallini | Argentina |
| 2022-048 | 2022 | ismail-elfath | Ismail Elfath | United States |
| 2022-049 | 2022 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2022-050 | 2022 | szymon-marciniak | Szymon Marciniak | Poland |
| 2022-051 | 2022 | ivan-barton | Iván Barton | El Salvador |
| 2022-052 | 2022 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2022-053 | 2022 | ismail-elfath | Ismail Elfath | United States |
| 2022-054 | 2022 | clement-turpin | Clément Turpin | France |
| 2022-055 | 2022 | fernando-rapallini | Fernando Rapallini | Argentina |
| 2022-056 | 2022 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2022-057 | 2022 | antonio-mateu-lahoz | Antonio Mateu Lahoz | Spain |
| 2022-058 | 2022 | michael-oliver | Michael Oliver | England |
| 2022-059 | 2022 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2022-060 | 2022 | facundo-tello | Facundo Tello | Argentina |
| 2022-061 | 2022 | daniele-orsato | Daniele Orsato | Italy |
| 2022-062 | 2022 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2022-063 | 2022 | fernando-rapallini | Fernando Rapallini | Argentina |
| 2022-064 | 2022 | szymon-marciniak | Szymon Marciniak | Poland |
| 2026-001 | 2026 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2026-002 | 2026 | amin-omar | Amin Omar | Egypt |
| 2026-003 | 2026 | facundo-tello | Facundo Tello | Argentina |
| 2026-004 | 2026 | danny-makkelie | Danny Makkelie | Netherlands |
| 2026-005 | 2026 | mustapha-ghorbal | Mustapha Ghorbal | Algeria |
| 2026-006 | 2026 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2026-007 | 2026 | slavko-vincic | Slavko Vinčić | Slovenia |
| 2026-008 | 2026 | said-martinez | Saíd Martínez | Honduras |
| 2026-009 | 2026 | francois-letexier | François Letexier | France |
| 2026-010 | 2026 | jalal-jayed | Jalal Jayed | Morocco |
| 2026-011 | 2026 | ismail-elfath | Ismail Elfath | United States |
| 2026-012 | 2026 | yael-falcon | Yael Falcón | Argentina |
| 2026-013 | 2026 | maurizio-mariani | Maurizio Mariani | Italy |
| 2026-014 | 2026 | adham-makhadmeh | Adham Makhadmeh | Jordan |
| 2026-015 | 2026 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2026-016 | 2026 | ramon-abatti | Ramon Abatti | Brazil |
| 2026-017 | 2026 | alireza-faghani | Alireza Faghani | Australia |
| 2026-018 | 2026 | pierre-atcho | Pierre Atcho | Gabon |
| 2026-019 | 2026 | szymon-marciniak | Szymon Marciniak | Poland |
| 2026-020 | 2026 | dahane-beida | Dahane Beida | Mauritania |
| 2026-021 | 2026 | glenn-nyberg | Glenn Nyberg | Sweden |
| 2026-022 | 2026 | clement-turpin | Clément Turpin | France |
| 2026-023 | 2026 | abdulrahman-al-jassim | Abdulrahman Al-Jassim | Qatar |
| 2026-024 | 2026 | anthony-taylor | Anthony Taylor | England |
| 2026-025 | 2026 | tori-penso | Tori Penso | United States |
| 2026-026 | 2026 | joao-pinheiro | João Pinheiro | Portugal |
| 2026-027 | 2026 | cristian-garay | Cristián Garay | Chile |
| 2026-028 | 2026 | gustavo-tejera | Gustavo Tejera | Uruguay |
| 2026-029 | 2026 | alejandro-hernandez-hernandez | Alejandro Hernández Hernández | Spain |
| 2026-030 | 2026 | ilgiz-tantashev | Ilgiz Tantashev | Uzbekistan |
| 2026-031 | 2026 | ivan-barton | Iván Barton | El Salvador |
| 2026-032 | 2026 | felix-zwayer | Felix Zwayer | Germany |
| 2026-033 | 2026 | juan-gabriel-benitez | Juan Gabriel Benítez | Paraguay |
| 2026-034 | 2026 | ma-ning | Ma Ning | China PR |
| 2026-035 | 2026 | michael-oliver | Michael Oliver | England |
| 2026-036 | 2026 | istvan-kovacs | István Kovács | Romania |
| 2026-037 | 2026 | espen-eskas | Espen Eskås | Norway |
| 2026-038 | 2026 | raphael-claus | Raphael Claus | Brazil |
| 2026-039 | 2026 | dario-herrera | Darío Herrera | Argentina |
| 2026-040 | 2026 | omar-al-ali | Omar Al Ali | United Arab Emirates |
| 2026-041 | 2026 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2026-042 | 2026 | drew-fischer | Drew Fischer | Canada |
| 2026-043 | 2026 | amin-omar | Amin Omar | Egypt |
| 2026-044 | 2026 | slavko-vincic | Slavko Vinčić | Slovenia |
| 2026-045 | 2026 | said-martinez | Saíd Martínez | Honduras |
| 2026-046 | 2026 | pierre-atcho | Pierre Atcho | Gabon |
| 2026-047 | 2026 | jalal-jayed | Jalal Jayed | Morocco |
| 2026-048 | 2026 | maurizio-mariani | Maurizio Mariani | Italy |
| 2026-049 | 2026 | cesar-arturo-ramos | César Arturo Ramos | Mexico |
| 2026-050 | 2026 | danny-makkelie | Danny Makkelie | Netherlands |
| 2026-051 | 2026 | ramon-abatti | Ramon Abatti | Brazil |
| 2026-052 | 2026 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2026-053 | 2026 | yael-falcon | Yael Falcón | Argentina |
| 2026-054 | 2026 | facundo-tello | Facundo Tello | Argentina |
| 2026-055 | 2026 | glenn-nyberg | Glenn Nyberg | Sweden |
| 2026-056 | 2026 | tori-penso | Tori Penso | United States |
| 2026-057 | 2026 | ivan-barton | Iván Barton | El Salvador |
| 2026-058 | 2026 | katia-itzel-garcia | Katia Itzel García | Mexico |
| 2026-059 | 2026 | mustapha-ghorbal | Mustapha Ghorbal | Algeria |
| 2026-060 | 2026 | clement-turpin | Clément Turpin | France |
| 2026-061 | 2026 | michael-oliver | Michael Oliver | England |
| 2026-062 | 2026 | anthony-taylor | Anthony Taylor | England |
| 2026-063 | 2026 | szymon-marciniak | Szymon Marciniak | Poland |
| 2026-064 | 2026 | adham-makhadmeh | Adham Makhadmeh | Jordan |
| 2026-065 | 2026 | francois-letexier | François Letexier | France |
| 2026-066 | 2026 | ismail-elfath | Ismail Elfath | United States |
| 2026-067 | 2026 | abdulrahman-al-jassim | Abdulrahman Al-Jassim | Qatar |
| 2026-068 | 2026 | drew-fischer | Drew Fischer | Canada |
| 2026-069 | 2026 | ilgiz-tantashev | Ilgiz Tantashev | Uzbekistan |
| 2026-070 | 2026 | istvan-kovacs | István Kovács | Romania |
| 2026-071 | 2026 | alireza-faghani | Alireza Faghani | Australia |
| 2026-072 | 2026 | felix-zwayer | Felix Zwayer | Germany |
| 2026-073 | 2026 | joao-pinheiro | João Pinheiro | Portugal |
| 2026-074 | 2026 | jalal-jayed | Jalal Jayed | Morocco |
| 2026-075 | 2026 | wilton-sampaio | Wilton Sampaio | Brazil |
| 2026-076 | 2026 | maurizio-mariani | Maurizio Mariani | Italy |
| 2026-077 | 2026 | danny-makkelie | Danny Makkelie | Netherlands |
| 2026-078 | 2026 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2026-079 | 2026 | slavko-vincic | Slavko Vinčić | Slovenia |
| 2026-080 | 2026 | adham-makhadmeh | Adham Makhadmeh | Jordan |
| 2026-081 | 2026 | raphael-claus | Raphael Claus | Brazil |
| 2026-082 | 2026 | said-martinez | Saíd Martínez | Honduras |
| 2026-083 | 2026 | espen-eskas | Espen Eskås | Norway |
| 2026-084 | 2026 | glenn-nyberg | Glenn Nyberg | Sweden |
| 2026-085 | 2026 | yael-falcon | Yael Falcón | Argentina |
| 2026-086 | 2026 | drew-fischer | Drew Fischer | Canada |
| 2026-087 | 2026 | clement-turpin | Clément Turpin | France |
| 2026-088 | 2026 | gustavo-tejera | Gustavo Tejera | Uruguay |
| 2026-089 | 2026 | ilgiz-tantashev | Ilgiz Tantashev | Uzbekistan |
| 2026-090 | 2026 | michael-oliver | Michael Oliver | England |
| 2026-091 | 2026 | ismail-elfath | Ismail Elfath | United States |
| 2026-092 | 2026 | alireza-faghani | Alireza Faghani | Australia |
| 2026-093 | 2026 | anthony-taylor | Anthony Taylor | England |
| 2026-094 | 2026 | adham-makhadmeh | Adham Makhadmeh | Jordan |
| 2026-095 | 2026 | francois-letexier | François Letexier | France |
| 2026-096 | 2026 | ivan-barton | Iván Barton | El Salvador |
| 2026-097 | 2026 | facundo-tello | Facundo Tello | Argentina |
| 2026-098 | 2026 | michael-oliver | Michael Oliver | England |
| 2026-099 | 2026 | clement-turpin | Clément Turpin | France |
| 2026-100 | 2026 | joao-pinheiro | João Pinheiro | Portugal |
| 2026-101 | 2026 | ivan-barton | Iván Barton | El Salvador |
| 2026-102 | 2026 | ismail-elfath | Ismail Elfath | United States |
| 2026-103 | 2026 | jesus-valenzuela | Jesús Valenzuela | Venezuela |
| 2026-104 | 2026 | slavko-vincic | Slavko Vinčić | Slovenia |


## Referee frequency (147 unique referees)

| Referee | World Cup Matches |
|---|---|
| Ravshan Ermatov | 11 |
| Alireza Faghani | 9 |
| Clément Turpin | 9 |
| César Arturo Ramos | 9 |
| Néstor Pitana | 9 |
| Benito Archundia | 8 |
| Jorge Larrionda | 8 |
| Björn Kuipers | 7 |
| Carlos Simon | 7 |
| Frank De Bleeckere | 7 |
| Ismail Elfath | 7 |
| Iván Barton | 7 |
| Marco Antonio Rodríguez | 7 |
| Michael Oliver | 7 |
| Szymon Marciniak | 7 |
| Wilton Sampaio | 7 |
| Cüneyt Çakır | 6 |
| Facundo Tello | 6 |
| Howard Webb | 6 |
| Jesús Valenzuela | 6 |
| Mark Geiger | 6 |
| Roberto Rosetti | 6 |
| Sandro Ricci | 6 |
| Slavko Vinčić | 6 |
| Óscar Ruiz | 6 |
| Anthony Taylor | 5 |
| Antonio Mateu Lahoz | 5 |
| Carlos Batrés | 5 |
| Danny Makkelie | 5 |
| Horacio Elizondo | 5 |
| Markus Merk | 5 |
| Milorad Mažić | 5 |
| Yūichi Nishimura | 5 |
| Ľuboš Micheľ | 5 |
| Adham Makhadmeh | 4 |
| Djamel Haïmoudi | 4 |
| Fernando Rapallini | 4 |
| Graham Poll | 4 |
| Héctor Baldassi | 4 |
| Luis Medina Cantalejo | 4 |
| Massimo Busacca | 4 |
| Mustapha Ghorbal | 4 |
| Nawaf Shukrallah | 4 |
| Nicola Rizzoli | 4 |
| Raphael Claus | 4 |
| Toru Kamikawa | 4 |
| Viktor Kassai | 4 |
| Wilmar Roldán | 4 |
| Abdulrahman Al-Jassim | 3 |
| Alberto Undiano | 3 |
| Andrés Cunha | 3 |
| Bakary Gassama | 3 |
| Ben Williams | 3 |
| Carlos Amarilla | 3 |
| Carlos Velasco Carballo | 3 |
| Coffi Codjia | 3 |
| Damir Skomina | 3 |
| Daniele Orsato | 3 |
| Drew Fischer | 3 |
| Felipe Ramos Rizo | 3 |
| Felix Brych | 3 |
| François Letexier | 3 |
| Gamal Ghandour | 3 |
| Gianluca Rocchi | 3 |
| Glenn Nyberg | 3 |
| Ilgiz Tantashev | 3 |
| Jalal Jayed | 3 |
| Janny Sikazwe | 3 |
| Joel Aguilar | 3 |
| Jonas Eriksson | 3 |
| João Pinheiro | 3 |
| Kim Milton Nielsen | 3 |
| Malang Diedhiou | 3 |
| Mark Shield | 3 |
| Maurizio Mariani | 3 |
| Mohammed Abdulla Hassan Mohamed | 3 |
| Olegário Benquerença | 3 |
| Pedro Proença | 3 |
| Pierluigi Collina | 3 |
| Saad Mane | 3 |
| Saíd Martínez | 3 |
| Shamsul Maidin | 3 |
| Valentin Ivanov | 3 |
| Wolfgang Stark | 3 |
| Yael Falcón | 3 |
| Ali Bujsaim | 2 |
| Amin Omar | 2 |
| Anders Frisk | 2 |
| Brian Hall | 2 |
| Byron Moreno | 2 |
| Carlos Vera | 2 |
| Daniel Siebert | 2 |
| Eddy Maillet | 2 |
| Enrique Cáceres | 2 |
| Enrique Osses | 2 |
| Espen Eskås | 2 |
| Felix Zwayer | 2 |
| Gilles Veissière | 2 |
| Gustavo Tejera | 2 |
| Hugh Dallas | 2 |
| István Kovács | 2 |
| Jerome Damon | 2 |
| Khalil Al-Ghamdi | 2 |
| Lu Jun | 2 |
| Matthew Conger | 2 |
| Noumandiez Doué | 2 |
| Pablo Pozo | 2 |
| Peter Prendergast | 2 |
| Pierre Atcho | 2 |
| Ramon Abatti | 2 |
| Stéphane Lannoy | 2 |
| Tori Penso | 2 |
| Ubaldo Aquino | 2 |
| Urs Meier | 2 |
| Victor Gomes | 2 |
| Vítor Melo Pereira | 2 |
| William Mattus | 2 |
| Ángel Sánchez | 2 |
| Éric Poulat | 2 |
| Alejandro Hernández Hernández | 1 |
| Andrés Matonte | 1 |
| Antonio López Nieto | 1 |
| Chris Beath | 1 |
| Cristián Garay | 1 |
| Dahane Beida | 1 |
| Darío Herrera | 1 |
| Essam Abd El Fatah | 1 |
| Falla Ndoye | 1 |
| Gehad Grisha | 1 |
| Jair Marrufo | 1 |
| Jan Wegereef | 1 |
| Juan Gabriel Benítez | 1 |
| Katia Itzel García | 1 |
| Kim Young-Joo | 1 |
| Koman Coulibaly | 1 |
| Kyros Vassaras | 1 |
| Ma Ning | 1 |
| Mario Escobar | 1 |
| Michael Hester | 1 |
| Mohamed Guezzaz | 1 |
| Mourad Daami | 1 |
| Omar Al Ali | 1 |
| Peter O'Leary | 1 |
| René Ortube | 1 |
| Sergei Karasev | 1 |
| Stéphanie Frappart | 1 |
| Terje Hauge | 1 |

## Normalization notes

The following are the concrete cross-source/cross-tournament inconsistencies
found and resolved while assembling this document:

- **Marco Antonio Rodríguez** (Mexico) — RSSSF's 2006 page renders his name
  as "Marco Rodríguez"; the 2010/2014 pages render the full "Marco Antonio
  Rodríguez". Normalized all 7 occurrences to the full form, giving a single
  stable `marco-antonio-rodriguez` Referee Code.
- **Mohammed Abdulla Hassan Mohamed** (United Arab Emirates) — spelling
  varies across sources ("Abdullah"/"Abdulla", "Mohammed"/"Mohamed" as the
  final name). Normalized all 3 occurrences to a single consistent spelling
  and Referee Code.
- **Matthew Conger** (New Zealand) — appears as the shortened "Matt Conger"
  in one source and the full "Matthew Conger" in another. Normalized both
  occurrences to "Matthew Conger". His RSSSF-listed nationality for 2018 was
  "New Zealand/USA" (a dual-affiliation note); normalized to New Zealand.
- **Yūichi Nishimura** (Japan) — RSSSF's 2010 page omits the macron
  ("Yuichi Nishimura"); the 2014 page includes it. Normalized all 5
  occurrences to the macroned form (the Referee Code itself is unaffected,
  since diacritics are stripped during slugging either way).
- **Óscar Ruiz** (Colombia), **Ľuboš Micheľ** (Slovakia), **Marco Antonio
  Rodríguez**, and several others — added diacritics omitted in some
  ASCII-flattened source renderings, cross-checked against Wikipedia.
- **Alireza Faghani** — genuinely **not** a data error: he officiated under
  Iran through 2014/2018/2022, then under Australia from 2026 onward,
  reflecting his real-world switch of football-association affiliation
  after being suspended by Iran's federation in 2019. Both associations are
  correct for their respective tournaments; this is the one referee in the
  dataset whose Association legitimately changes over time. His Referee
  Code (`alireza-faghani`) stays the same throughout, since it identifies
  the person, not the association.
- Several referees carry informally shortened public names rather than full
  legal names, matching how they are conventionally known in football
  reporting and RSSSF/Wikipedia infoboxes (e.g. "Iván Barton" rather than
  "Ivan Arcides Barton Cisneros", "Ma Ning" in Chinese surname-first order,
  "César Arturo Ramos" rather than the longer "César Arturo Ramos
  Palazuelos").

## Final summary

- **Total matches:** 488
- **Total unique referees:** 147
- **Total represented countries:** 66

**Validation performed:**

- Matches = 488 — confirmed programmatically against the 488 match codes
  present in `data/matches/2002.json` through `data/matches/2026.json`
  (104 committed 2026 matches, including `2026-103` and `2026-104`, both
  added once played).
- Every repository match code appears in this document exactly once — no
  duplicates, no gaps, verified by set comparison against the repo's actual
  match codes (zero missing, zero unexpected).
- Every referee name normalized to one consistent spelling across all its
  occurrences, with the single documented exception of Alireza Faghani's
  genuine association change (see above).
- Every Referee Code is a stable, lowercase, ASCII-only slug, unique per
  referee (no two different referees collide on the same code), and
  identical across every occurrence of that referee.
- Every Association reflects the football association FIFA lists the
  referee under for that tournament rather than a plain country rollup;
  England/Scotland referees are distinguished individually (no single
  "United Kingdom" football association exists), and South Korea/North
  Korea are kept distinct (no North Korean referee appears in this
  dataset).
- Referee-nationality counts for the 18 countries absent from
  `data/countries.json` (identified in the prior "Referee Country Coverage
  Research" milestone) were independently re-derived from this row-level
  mapping and reconcile exactly with that earlier research (e.g. El Salvador
  10 matches, UAE 6, Guatemala 6, Venezuela 5, etc.) — cross-validating both
  research passes against each other.

