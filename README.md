# Checkpoint 2

## Steps

0. Clone the repo from Github.
0. Run `composer install`.
0. Create a database (e.g. named `checkpoint2`)
0. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```

0. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
0. Go to `localhost:8000` with your favorite browser.
0. Clic on "Intructions" button.
