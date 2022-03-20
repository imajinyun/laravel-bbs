# 🌈 A small application of practice training based on laravel framework

## Requirements

* PHP >= 8.0.0
* Laravel >= 9.0

## Installation

> This project requires PHP 8+ and Laravel 9.

```bash
// Clone source code.
$ git clone git@github.com:imajinyun/laravel-bbs.git

// Copy .env.development to .env, and fill in the relevant configuration values.
$ cd laravel-bbs && cp .env.development .env

// Install dependencies for application.
$ composer install

// To start Sail.
$ ./vendor/bin/sail up

// Enter laravel-bbs-app container.
$ docker exec -it laravel-bbs-app /bin/bash

// Execute migration command.
$ php artisan migrate --seed
```

## Features

## Screenshots

![laravel-bbs-frontend](https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/screenshots/laravel-bbs-frontend.png)

## About

## License

The Laravel BBS is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
