# PHP Git Commit Analyser

[![Latest Version](https://img.shields.io/github/release/anroots/pgca.svg?style=flat-square)](https://github.com/anroots/pgca/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/anroots/pgca/master.svg?style=flat-square)](https://travis-ci.org/anroots/pgca)
[![Quality Score](https://img.shields.io/sensiolabs/i/83f5f769-be6c-4913-8de3-086b07d45e61.svg)](https://insight.sensiolabs.com/projects/83f5f769-be6c-4913-8de3-086b07d45e61)
[![Total Downloads](https://img.shields.io/packagist/dt/anroots/pgca.svg?style=flat-square)](https://packagist.org/packages/anroots/pgca)

A CLI tool which analyses Git commits for violations.

How often have you seen commit messages such as "fix some stuff"? This tool aims to improve the quality of
your commit practices by applying a set of rules against your commit (message) and then yelling at you if you get too lazy.

**Development status: alpha, ongoing. Unstable public API. Use at your own risk.**

## Install

1. Include the analyzer via Composer:

```json
{ 
  "require": {
    "anroots/pgca": "~0.1"
  }
}
```

2. Copy `config/pgca.yml` into your project root directory and change its contents as needed.

## Usage

Run the analyzer from CLI:

```bash
$ vendor/bin/pgca analyze
```

Pgca is flexible in the way it can be set up:

- Include it into your current project via Composer to analyse its commits
- Write a small webhook script and let GitLab run it
- Include it into your CI build
- Have a standalone, manually run instance that tracks remote commits (GitHub)


Print the "simple" report in table format to the console and analyse the last 40 Git commits of the current branch:

```bash
$ bin/pgca analyze --printer=console --serializer=console --composer=simple --revision=HEAD~40..HEAD                                                                                       1 ↵
PGCA report, generated on 2015-04-12 15:08:06
+---------+------------+-------------------------+--------------------------------------------------+
| Commit  | Author     | Commit Message          | Explanation                                      |
+---------+------------+-------------------------+--------------------------------------------------+
| 342a207 | Ando Roots | Readme additions        | Commit message is really short                   |
| 8ba29a8 | Ando Roots | Add five new Rules      | Commit message is really short                   |
| a7c97f9 | Ando Roots | Refactor AbstractRul... | The Summary line should be 50 or less characters |
+---------+------------+-------------------------+--------------------------------------------------+
```

_Todo: write setup and usage guide_


## Rules

Many rule definitions are taken from [A Note About Git Commit Messages](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).

For a full list of available rules, run `vendor/bin/pgca/rules`:

```bash
$ vendor/bin/pgca rules
+-------------------------------------+----------+
| Name                                | Category |
+-------------------------------------+----------+
| message.hasSummaryAndDescription    | Message  |
| message.isLongEnough                | Message  |
| message.startsWithCapitalLetter     | Message  |
| message.summaryFiftyOrLessChars     | Message  |
| message.oneBlankLineAfterSummary    | Message  |
| message.noTrailingWhitespace        | Message  |
| message.noTrailingNewline           | Message  |
| message.noDoubleWhitespace          | Message  |
| message.allLinesLessThanThreshold   | Message  |
| message.notTypicalNonsense          | Message  |
| message.noProfanity                 | Message  |
| message.noProfanity                 | Message  |
| message.summaryDoesNotEndWithPeriod | Message  |
| content.hasNoIgnoredFiles           | Content  |
+-------------------------------------+----------+
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Backlog

These are the broader topics that need improvement and are planned in the undefined near future:

**Rule implementations**

- [message] summary is in present / imperative form
- [message] has ticket reference in commit message
- [message] is in English
- [content] commit does not contain excessive changed file count (commits that change 100 files)

**Refactoring**

- Add more in-code documentation
- Increase unit test coverage
- Refactor code, from proof-of-concept version to 1.0 quality
- Improve HTML report
- Create a command for showing details about a particular rule (`rules:show`), refactor `rules` into `rules:list`
- Add longer 'explanation' block to all rules. Might be 2-3 paragraphs with examples and a long explanation why this particular rule exists

## Credits

- [Ando Roots](https://github.com/anroots)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
