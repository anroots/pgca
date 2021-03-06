# Changelog

All Notable changes to `anroots/pgca` will be documented in this file. The package follows [SemVer](http://semver.org) versioning scheme.

## NEXT_VERSION

## Added
- Nothing

## 0.2.1 2015-04-28

### Deprecated
- GitHub provider is now an optional dependency
- Downgraded to PHPUnit 4.5

## 0.2.0

### Added
- Console report footer now shows counts of analyzed commits
- Rules now have a 'severity' attribute
- A new CLI flag, '--tolerance' can be used to indicate when the analyzer should fail 
- New report, `BlameReport` can be used to list violations by author
- New command, `rules:show` for showing details about a rule
- New optional argument `category` for the `rules:list` command

### Changed
- Config file path for rules is now `analyzer.rules`
- `rules` command renamed to `rules:list`
- CLI options are now prefixed with dot notation corresponding to their names in pgca.yml. For example, if the pgca.yml has `provider.path` then the CLI option is `--provider-path`

## 0.1.0

Initial alpha release. Very basic, proof-of-concept functionality implemented.