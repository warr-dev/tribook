## Tribook
This is a tricycle booking app made with html css and javascript for frontend and php backend. It uses JQuery mobile library. For API backend, it uses PHP with Laravel framework.

Features includes:
- booking
- pickup
- tricycle/driver
- transaction history

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


### Others

#### Setting up ssh
 this project contains devcontainer (vscode preconfigured) together with dependencies for easier get started on development, however, if you want to use ssh on pushing on repository, you had to setup ssh. to set it up:
 - open terminal inside container type `ssh-keygen`
 - copy the output public key xxx.pub
 - add ssh key to your github account