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


CREATE TABLE `accessory` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `cupcake` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `color1` CHAR(7) NOT NULL,
    `color2` CHAR(7) NOT NULL,
    `color3` CHAR(7) NOT NULL,
    `accessory_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`accessory_id`) REFERENCES `accessory`(`id`)
);

🧁 Step 6

On the Cupcake list there is an href link around each cupcake to show You have to create the method and the view for this step.
Be sure to display the cupcake accessory on this page ! (use a SQL JOIN)

For the bonus section, you can choose between bonus 1 and bonus 2, which is a little more complex. Of course, you can do both if you like 🤓.
💪 BONUS 1: Cupcake day 🎉

Your cupcakes look delicious and their accessories attract customers to the factory. Their originality requires different selling prices depending on their composition.

And what's more, today is cupcake day! 🎉
For every three cupcakes you buy, you get a 50-cent discount at the checkout.

There are plenty of customers, and you'll need a high-performance calculator to apply the right price quickly.

    Take a look at /src/Service/Checkout.php.

    Create a calculate() method, which takes a multi-dimensional array $cart as its parameter. Each element of the array is an associative array containing the indexes 'numberCupcake' and 'unitPrice'.
    For example, for an order of 4 cupcakes at 5.5 euros each, 3 cupcakes at 2.5 euros each and 2 cupcakes at 1.5 euros each, the $cart array would be constructed as follows:

                    
        $cart = [
            ['numberCupcake' => 4, 'unitPrice' => 5.5],
            ['numberCupcake' => 3, 'unitPrice' => 2.5],
            ['numberCupcake' => 2, 'unitPrice' => 1.5],
        ];
                

    Because these cupcake numbers and unit prices will be retrieved from an already implemented form, you don't have to write any data in the method, just the calculation rule.

    The calculate() method must return an array containing the total price at the first index, and the total price minus the discount applied (50-cent) for every three cupcakes purchased at the second index.

    In the above example, the method should therefore return

    [32.5, 31]

Test !!
As in code wars, you have some tests provided in file tests/Service/CheckoutTest.
You can launch tests using the command in your terminal.

vendor/bin/phpunit --colors=auto tests/Service/CheckoutTest.php

When the method works and tests are green, look at page cupcake-day, you can play with the cash register 💰.
💪💪 BONUS 2: Logistics 🚚

Now, we want to send our cupcakes. To optmize packaging, we need to put cupcakes in containers. We have 3 sizes of boxes

    Small : 2 cupakes max
    Medium : 5 cupakes max
    Large : 8 cupakes max

Important !! An optimize packaging means a minimum number of containers and the minimum empty spaces in not full containers. If we have multiple possibilities, we will try to use larger boxes first.

    Exemple 1 : 7 cupcakes => 1 container L (and 1 empty slot)
    Exemple 2 : 14 cupcakes => 2 containers L
    Exemple 3 : 16 => 2 containers L
    Exemple 4 : 18 => 2 containers L, 1 container S
    Exemple 5 : 20 => 2 containers L, 1 container M (1 empty slot)

Test !!
You also have tests supplied in file tests/Service/ContainerTest.
You can launch tests using the command in your terminal.

vendor/bin/phpunit --colors=auto tests/Service/ContainerTest.php

    Look at the file : /src/Service/Container.php
    In this class Container, create a method inbox(int $numberCake): array
    which shoud return an array with: [number of L boxes, number of M boxes, number of S boxes]
    In this class, create 3 constants : SMALL = 2, MEDIUM = 5 and LARGE = 8
    When the method works and tests are green, look at page logistics
    You will find a form where you can indicate number of cupcakes. Then, using your inbox() method, display thenumber of each container (L, M and S) from the number of cupcakes submitted in the form.
