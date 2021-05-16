# Be-Smart Learning Management System

Learning Management System is a website to make learning system in school more digitalize , This LMS called Be-Smart . This website using laravel as backend framework and jquery and css as front end .

## Getting Started
Several things that you need to do before running this project .

### Prerequisites
Some tools that you need to install or you need to know .
* [XAMPP](https://www.apachefriends.org/index.html/)
* [Laravel](https://www.laravel.com)
* [Bootstrap](https://getbootstrap.com/docs/4.5/getting-started/introduction/)
* [JQuery](https://jquery.com/)
* [Composer](https://getcomposer.org/)
* [Git](https://git-scm.com/)

### Installations
Installation step to use this project in your machine

Clone this repo
```
git clone https://github.com/renaldy23/Project-Learning-Management-System.git
```

Install the package for this project , run this command
```
composer install
```

Generate app key for laravel , run this command
```
php artisan key:generate
```

Create new database on your Database engine . after that Migrate and seeding the database , run this command
```
php artisan migrate
php artisan db:seed
```

run this project , run this command 
```
php artisan serve
```

Login info
```
username : admin1234
password : secret
```