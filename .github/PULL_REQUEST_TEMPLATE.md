## Summary

<!-- One or two sentences: what does this PR change, and why? -->

## Type of change

- [ ] Data correction (a value in `data/` was wrong)
- [ ] New tournament / new records
- [ ] Documentation
- [ ] Test suite
- [ ] Repository metadata / tooling (CI, `composer.json`, etc.)

## Source

<!--
Required for any change to data/. State which source supports the change and quote the
specific value. See docs/DATA_SOURCES.md for the source policy:
- OpenFootball is primary for everything except kickoff_at.
- FIFA (api.fifa.com) is authoritative only for kickoff_at.
- Wikidata/Wikipedia are used only to fill stadium coordinates OpenFootball doesn't provide.
Not applicable to documentation-only or tooling-only PRs — delete this section if so.
-->

## Checklist

- [ ] One logical change per PR (see `docs/CONTRIBUTING.md`)
- [ ] `composer test` passes locally
- [ ] Record `id` values were not regenerated (UUIDs are permanent — see `docs/CONVENTIONS.md`)
- [ ] `docs/CHANGELOG.md` updated under "Unreleased" (required for any change to `data/`)
- [ ] `docs/CONVENTIONS.md` / `docs/DATA_MODEL.md` updated if this PR changes a rule they document
