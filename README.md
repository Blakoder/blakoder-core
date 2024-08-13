# Collection of essential Blakoder Utilities

[![Latest Version on Packagist](https://img.shields.io/packagist/v/blakoder/core.svg?style=flat-square)](https://packagist.org/packages/blakoder/core)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/blakoder/blakoder-core/run-tests.yml?branch=main\&label=tests\&style=flat-square)](https://github.com/blakoder/blakoder-core/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/blakoder/blakoder-core/fix-php-code-style-issues.yml?branch=main\&label=code%20style\&style=flat-square)](https://github.com/blakoder/blakoder-core/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/blakoder/core.svg?style=flat-square)](https://packagist.org/packages/blakoder/core)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require blakoder/core
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="blakoder-core-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="blakoder-core-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="blakoder-core-views"
```

## Usage

```php
$core = new Blakoder\Core\Blakoder();
echo $core->echoPhrase('Hello, Blakoder!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [Ivan Sotelo](https://github.com/Blakoder)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
