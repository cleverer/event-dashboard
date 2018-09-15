# event-dashboard
A simple dashboard to publish events.

## Requirements
- [composer](https://getcomposer.org)
- npm ([node.js](https://nodejs.org/))
- Further requirements: [Laravel Requirements](https://laravel.com/docs/5.6#server-requirements)

## Installation

Composer and npm are assumed working.

1. Clone the repository. The webroot should point to the public folder of the repository, but the php open_dir should include the full repo.
2. Duplicate the file _.env.example_ and rename it to _.env_.
    1. Fill out all config options except `APP_KEY`.
3. Execute the following commands:

    ```shell
    composer install --optimize-autoloader --no-dev;
    npm install;
    php artisan key:generate;
    npm run prod;
    php artisan migrate;
    php artisan config:cache;
    php artisan route:cache;
    ```
    
4. Enjoy!

## Updating

Use the following commands to update an existing install:

> Caution: `php artisan migrate --force` might potentially be destructive!

```shell
php artisan down;
git pull;
composer install --optimize-autoloader --no-dev;
npm install;
npm run prod;
php artisan migrate --force;
php artisan config:cache;
php artisan route:cache;
php artisan up;
```
