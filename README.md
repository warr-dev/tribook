## How to run
---
### Prerequisites
- php
- mysql
- terminal
- composer
### Running
- on terminal run
    - `cp .env.example .env`
    - edit database fields matching your database on .env file
    - `php artisan key generate`
    - `composer install`
    - `php artisan migrate:fresh --seed`
    - `php artisan storage:link` to make client availablle via /client
    - run via webserver or `php artisan serve` for development
client app (mobile web) and converted app (apk) are available on frontend folder at public folder
