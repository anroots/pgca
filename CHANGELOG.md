# Changelog

All Notable changes to `anroots/pgca` will be documented in this file. The package follows [SemVer](http://semver.org) versioning scheme.

## NEXT - YYYY-MM-DD

### Added
- Console report footer now shows counts of analyzed commits
- Rules now have a 'severity' attribute
- A new CLI flag, '--tolerance' can be used to indicate when the analyzer should fail 
- New report, `BlameReport` can be used to list violations by author
- New command, `rules:show` for showing details about a rule
- New optional argument `category` for the `rules:list` command

### Deprecated
- Nothing

### Changed
- Config file path for rules is now `analyzer.rules`
- `rules` command renamed to `rules:list`

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing

## 0.1.0

Initial alpha release. Very basic, proof-of-concept functionality implemented.