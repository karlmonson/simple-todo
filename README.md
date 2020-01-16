# Simple To-Do List

This is a simple to-do list app built with Laravel and VueJS.

## Setup

Clone this repository, then run the following command to install the required packages using composer:

```bash
composer install
cp env.example .env
```

Next, create a database and enter the credentials in your new `.env` file. Then run:

```bash
php artisan migrate --seed
```

This will create a dummy user with a password. Check your database for the credentials.

Then, login and you can add tasks using the simple form, and mark them as complete as you get things done.

P.S. I made this in 50 minutes.
