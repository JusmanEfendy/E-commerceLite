## Tech Stack

**Client:** [ruangAdminLTE](https://github.com/indrijunanda/RuangAdmin), Bootstrap, Jquery, filePond

**Server:** PHP 8.1.x, Laravel 10.x


## Dependencies

- [Laravel Breeze](https://github.com/laravel/breeze)
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum#main-content)
- [Guzzle](https://github.com/guzzle/guzzle)


## Features

- AdminLTE template
- Authentication with Laravel Breeze
- User & Roles management (two access rights [admin, client])
- SweetAlert installed


## Installation 

You can fork or clone this project

``` 
git clone https://github.com/abdulfalaq5/pintar-FSD.git
cd pintar-FSD
composer install
cp .env.example .env <-- edit db config
php artisan key:generate
php artisan migrate:fresh --seed
```
That's it!


## Admin credentials
- **Email:** jussy@gmail.com
- **Password:** jussy0206


## Output Dashboard

<img width="946" alt="dashboard" src="public/template/dist/img/dashboard.png">