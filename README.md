# PHP Form Fields (for WordPress)

![Current Branch](https://img.shields.io/badge/version-0.1.x-green?style=for-the-badge) [![Latest Version on Packagist](https://img.shields.io/packagist/v/piggly/php-form-fields.svg?style=for-the-badge)](https://packagist.org/packages/piggly/php-form-fields) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=for-the-badge)](LICENSE) ![PHP](https://img.shields.io/packagist/php-v/piggly/php-form-fields?style=for-the-badge)

The PHP Form Field (for WordPress) is a versatile and intuitive PHP library that empowers developers to quickly and easily render HTML form fields using object-oriented programming.

Developed with the goal of enhancing the configuration screens of WordPress plugins, this library provides a wide range of powerful form field types designed to work seamlessly with the [pgly-wps-settings](https://www.npmjs.com/package/@piggly/pgly-wps-settings) javascript/css library.

Released under the permissive MIT license, `php-form-fields` is the perfect boilerplate for any developer seeking to optimize their workflow. With PHPUnit-powered unit tests and a simple, dependable interface, `php-form-fields` is the ultimate choice for anyone looking to streamline their development process.

⚠️ Please be advised that while `php-form-fields` is a powerful and versatile library, it is still in the experimental stage and may undergo unexpected changes. We are continually working to optimize and improve the library, and a stable release will be made available in the near future. In the meantime, we encourage you to explore the library and offer any feedback or suggestions you may have. Together, we can make `php-form-fields` the ultimate tool for streamlined development.

## Installation

### Composer

The recommended way to install `php-form-fields` is through [Composer](https://getcomposer.org/). Run the following command in your terminal:

```bash
composer require piggly/php-form-fields
```

Don't forget to add Composer's autoload file at your code base `require_once('vendor/autoload.php);`.

### Manual installation

You can also install `php-form-fields` manually by downloading the latest release from the GitHub repository and including the library files in your project.

1. Download the release version or clone with repository with git clone `https://github.com/piggly-dev/php-form-fields.git`;
2. After, goes to folder you have downloaded `cd /path/to/piggly/php-form-fields`;
3. Install all Composer's dependencies with `composer install`;
4. Add project's autoload file at your code base `require_once('/path/to/piggly/php-form-fields/vendor/autoload.php);`.


## Dependencies

The library has the following external dependencies:

* PHP 7.2+.

## Changelog

See the [CHANGELOG](CHANGELOG.md) file for information about all code changes.

## Testing the code

This library uses the PHPUnit. We carry out tests of all the main classes of this application. To run the tests, run the following command in your terminal from the root directory of the library:

```bash
vendor/bin/phpunit
```

> You must always run tests with PHP 7.2 and greater.

## Contributions

See the [CONTRIBUTING](CONTRIBUTING.md) file for information before submitting your contribution.

## Credits

- [Caique Araujo](https://github.com/caiquearaujo)
- [All contributors](../../contributors)

## Support the project

Piggly Studio is an agency located in Rio de Janeiro, Brazil. If you like this library and want to support this job, be free to donate any value to BTC wallet `3DNssbspq7dURaVQH6yBoYwW3PhsNs8dnK` ❤.

## License

MIT License (MIT). See [LICENSE](LICENSE).