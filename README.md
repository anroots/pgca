# PHP Git Commit Analyser

[![Latest Version](https://img.shields.io/github/release/anroots/pgca.svg?style=flat-square)](https://github.com/anroots/pgca/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/anroots/pgca/master.svg?style=flat-square)](https://travis-ci.org/anroots/pgca)
[![Quality Score](https://img.shields.io/sensiolabs/i/83f5f769-be6c-4913-8de3-086b07d45e61.svg)](https://insight.sensiolabs.com/projects/83f5f769-be6c-4913-8de3-086b07d45e61)
[![Total Downloads](https://img.shields.io/packagist/dt/anroots/pgca.svg?style=flat-square)](https://packagist.org/packages/anroots/pgca)

A CLI tool which analyses Git commits for violations.

This project aims to improve the quality of your commit practices by applying a set of rules against your commit (message) and then yelling at you when you get too lazy.

The project was born from frustration of seeing commit messages like "fix some stuff" and people's inability to write [good commit messages](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).

**Development status:** Alpha, ongoing. Unstable public API. Is usable.**

## Install

- Include via Composer:

```json
{ 
  "require": {
    "anroots/pgca": "~0.2"
  }
}
```

- Copy `config/pgca.yml` into your project root
- Customize the contents of `pgca.yml`

## Usage

To analyze the commit history of the current project, run the analyzer from the command line:

```bash
athena PhpstormProjects/todo-app ‹develop*› » vendor/bin/pgca analyze       
PGCA report, generated on 2015-04-25 11:01:04
+---------+------------+-------------------------+--------------------------------------------------+
| Commit  | Author     | Commit Message          | Explanation                                      |
+---------+------------+-------------------------+--------------------------------------------------+
| 2dda109 | Ando Roots | Add a note to the RE... | The Summary line should be 50 or less characters |
| 342a207 | Ando Roots | Readme additions        | Commit message is really short                   |
| 8ba29a8 | Ando Roots | Add five new Rules      | Commit message is really short                   |
| a7c97f9 | Ando Roots | Refactor AbstractRul... | The Summary line should be 50 or less characters |
| 9a43610 | Ando Roots | Reformat code           | Commit message is really short                   |
| 2b29b55 | Ando Roots | Allow to pass option... | The Summary line should be 50 or less characters |
| 2efbbe5 | Ando Roots | Add --limit and --fr... | The Summary line should be 50 or less characters |
+---------+------------+-------------------------+--------------------------------------------------+
Found a total of 80 commits, skipped 0 and analyzed 80 of them.
The total score was 7
```

You can customize the analysis in the `pgca.yml` file and with CLI options.

Print the "simple" report in table format to the console and analyse the last 40 Git commits of the current branch:

```bash
$ vendor/bin/pgca analyze --report-printer=console --report-serializer=console --report-composer=simple --provider-revision=HEAD~40..HEAD                                                                                       1 ↵
PGCA report, generated on 2015-04-12 15:08:06
+---------+------------+-------------------------+--------------------------------------------------+
| Commit  | Author     | Commit Message          | Explanation                                      |
+---------+------------+-------------------------+--------------------------------------------------+
| 342a207 | Ando Roots | Readme additions        | Commit message is really short                   |
| 8ba29a8 | Ando Roots | Add five new Rules      | Commit message is really short                   |
| a7c97f9 | Ando Roots | Refactor AbstractRul... | The Summary line should be 50 or less characters |
+---------+------------+-------------------------+--------------------------------------------------+
Found a total of 40 commits, skipped 0 and analyzed 40 of them.
The total score was 3
```

## Documentation

See [the wiki](https://github.com/anroots/pgca/wiki) for more documentation.

## Requirements

* PHP >= 5.6
* [Composer](http://getcomposer.org)

## Rules

See [the wiki](https://github.com/anroots/pgca/wiki/Rules) for documentation about standard rules. For a full list of available rules, run `vendor/bin/pgca/rules:list`:

```bash
$ vendor/bin/pgca rules:list
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
- Refactor code, from alpha version to 1.0 quality
- Improve HTML report
- Add longer 'explanation' block to all rules. Might be 2-3 paragraphs with examples and a long explanation why this particular rule exists

## Credits

- [Ando Roots](https://github.com/anroots)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
