## Laravel
# How to use
s
* Run:
```
composer install
```
```
Configure the db in the .env file
```
* To upload the project, execute:
```
php artisan serve
```
* Run migrates
```
php artisan make:migration migrateName
```
-----------------------------------------
* Access to home:
```
http://127.0.0.1:8000/livros
```
* Run Tests
```
vendor/bin/phpunit
```
------------------------------------------
* For the artisan commands:
https://laravel.com/docs/7.x

* Deploy Prod
```
composer install
```
```
php artisan key:generate
```
```
In the .env file, the APP_ENV property must be prod and APP_DEBUG must be false
```
