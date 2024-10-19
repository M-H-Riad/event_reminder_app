## Installation Process
- Pull from the Git repository
- Run `composer install`
- Run `cp .env.example .env` [Make sure you provided database connection and SMTP credentials properly.]
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` [Make sure database is connected]
- Run `npm install`
- Run `npm run build`
- Run `php artisan serve`
- Now visit "http://127.0.0.1:8000/"

 ## Login Credentials
- Email: superadmin@example.com
- Password: 12345678
