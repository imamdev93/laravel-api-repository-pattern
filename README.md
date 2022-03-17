<a href="https://codeclimate.com/github/imamdev93/laravel-api-repository-pattern/maintainability"><img src="https://api.codeclimate.com/v1/badges/dfeb66ebab751c9fee0e/maintainability" /></a>
<a href="https://codeclimate.com/github/imamdev93/laravel-api-repository-pattern/test_coverage"><img src="https://api.codeclimate.com/v1/badges/dfeb66ebab751c9fee0e/test_coverage" /></a>

# LARAVEL API REPOSITORY PATTERN

## Spesifikasi
- Laravel 9.x
- MySQL 5.7.xx
- Composer 2.x
- PHP 8.1.x
- XDEBUG_MODE = ON (opsional. atur di `php.ini`)

## Installation
```sh
$ git clone git@github.com:imamdev93/laravel-api-repository-pattern.git
$ cd laravel-api-repository-pattern
$ cp .env.example .env
$ php artisan key:generate
$ composer install
$ ubah konfigurasi database
$ php artisan migrate --seed
$ php artisan serve => http://127.0.0.1:8000
```

### Jalankan Unit dan Feature Test
```
$ ./vendor/bin/phpunit
```
