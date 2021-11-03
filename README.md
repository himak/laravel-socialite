# Laravel OAuth Example App

Login or Register user with help socials as **GitHub** or **Facebook**. This is example PHP Laravel App used official package [Laravel Socialite](https://laravel.com/docs/8.x/socialite).


Install dependences:

	composer install

Create config file and fill DB, OAuth token:

	cp .env.example .env

Create database tables:

	php artisan migrate

Create [Facebook](https://developers.facebook.com/apps/create/) and [Github](https://github.com/settings/applications/new) apps and fill ID and secret key in .env file:

    GITHUB_CLIENT_ID=""
    GITHUB_CLIENT_SECRET=""
    FACEBOOK_CLIENT_ID=""
    FACEBOOK_CLIENT_SECRET=""

Run app:

	php artisan serve

Open browser:

	http://localhost:8000
