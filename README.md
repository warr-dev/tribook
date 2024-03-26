## How to run (development)
---
This can be run using 
- host (install servers on host eg. WAMP XAMPP Laragon)
- devcontainer (easier, recommended)
---
### DevContainer (container with ide vscode integrated)
#### Prerequisites
- docker/docker desktop
- vscode
- vscode devcontainer extension
#### Running
- `ctrl + shift + p`
- type `dev container` select `open folder in container`
  
##### when done opening in container open terminal and follow steps on run on [host](#host-machine)

---

### host machine
#### Prerequisites
- php
- mysql
- composer
### Running
    - `cp .env.example .env`
    - edit database fields matching your database on `.env` file
    - `php artisan key generate`
    - `composer install`
    - `php artisan migrate:fresh --seed`
    - `php artisan storage:link` to make client availablle via /client
    - run via webserver or `php artisan serve` for development

---
- open via web client using {app_url}/client/index.html
- set server setting ex. http://127.0.0.1:8000
- you can also convert webclient to mobile app
- see also 
    - [screens](screens.md)
