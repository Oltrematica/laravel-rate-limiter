![GitHub Tests Action Status](https://github.com/Oltrematica/laravel-rate-limiter/actions/workflows/run-tests.yml/badge.svg)
![GitHub PhpStan Action Status](https://github.com/Oltrematica/laravel-rate-limiter/actions/workflows/phpstan.yml/badge.svg)

# Oltrematica API Rate Limiter

A Laravel package to manage rate limiters for APIs, used internally at Oltrematica for our projects.

## Introduction

This package provides a simple configuration for rate limiters in APIs, allowing easy management of requests for login,
registration, and general API routes. It is designed to be straightforward to integrate and configure within Laravel
projects.

## Installation

To install the package, run the following command in your terminal:

```bash
composer require oltrematica/laravel-rate-limiter
```  

## Configuration

The package includes a configuration file that can be customized. To publish the configuration file to your project, run
the following command:

```bash
php artisan vendor:publish --provider="Oltrematica\RateLimiter\RateLimiterServiceProvider" --tag="ratelimiter-config"
```

This will publish the `rate-limiter.php` configuration file into your project's `config` directory.

## Usage

To apply rate limiters, use the following middleware in your routes:

- **API Rate Limiter**: Use the `throttle:api` middleware to apply rate limiting to API requests.
- **Login Rate Limiter**: Use the `throttle:login` middleware to apply rate limiting to login requests.
- **Register Rate Limiter**: Use the `throttle:register` middleware to apply rate limiting to registration requests.

### Examples

#### Applying Rate Limiting to API Routes

In `routes/api.php`:

```php
Route::middleware(['throttle:api'])->group(function () {
// API routes go here
});
```

#### Applying Rate Limiting to Login Route

In `routes/web.php`:

```php
Route::post('/login', 'LoginController@login')->middleware('throttle:login');
```

#### Applying Rate Limiting to Registration Route

In `routes/web.php`:

```php
Route::post('/register', 'RegisterController@register')->middleware('throttle:register');
```

## Configuration Options

The `rate-limiter.php` configuration file allows you to customize request limits for each type of rate
limiter. You can override default values using environment variables in your `.env` file.

### Example `.env` Variables

```env
RATE_LIMITING_API_IGNORE_ADMINS=true
RATE_LIMITING_API_LIMIT=60
RATE_LIMITING_API_LOGIN_LIMIT=60
RATE_LIMITING_API_LOGIN_LIMIT_PER_EMAIL=10
RATE_LIMITING_API_REGISTER_LIMIT=60
```

## Code Quality

The project includes automated tests and tools for code quality control.

### Rector

Rector is a tool for automating code refactoring and migrations. It can be run using the following command:

```shell
composer refactor
```

### PhpStan

PhpStan is a tool for static analysis of PHP code. It can be run using the following command:

```shell
composer analyse
```

### Pint

Pint is a tool for formatting PHP code. It can be run using the following command:

```shell
composer format
```

### Automated Tests

The project includes automated tests and tools for code quality control.

```shell
composer test
```

## Contributing

Feel free to contribute to this package by submitting issues or pull requests. We welcome any improvements or bug fixes
you may have.