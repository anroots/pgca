# PHP Git Commit Analyser

[![Latest Version](https://img.shields.io/github/release/anroots/pgca.svg?style=flat-square)](https://github.com/anroots/pgca/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/anroots/pgca/master.svg?style=flat-square)](https://travis-ci.org/anroots/pgca)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/anroots/pgca.svg?style=flat-square)](https://scrutinizer-ci.com/g/anroots/pgca/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/anroots/pgca.svg?style=flat-square)](https://scrutinizer-ci.com/g/anroots/pgca)
[![Total Downloads](https://img.shields.io/packagist/dt/anroots/pgca.svg?style=flat-square)](https://packagist.org/packages/anroots/pgca)

*Work in progress! Do not use!*

## Todo: rule implementations

- summary line is 50 characters or less
- commit message is a typical "blagh": "fix stuff", "do some work" etc
- Every line is below 72 characters long
- has summary line
- has description line
- has blank line between summary and description
- summary is in present / imperative form
- has ticket reference in commit message
- line contains trailing whitespace at the end of the line
- message contains two consecutive whitespaces between words (allowed for formatting lists)

http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html

## Install

Via Composer

``` bash
$ composer require anroots/pgca
```

## Usage

TODO

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email ando@sqroot.eu instead of using the issue tracker.

## Credits

- [Ando Roots](https://github.com/anroots)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
