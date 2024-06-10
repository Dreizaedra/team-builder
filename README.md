PHPStan :
```bash
php vendor/bin/phpstan --memory-limit=1G
```

PHPUnit :
```bash
php bin/phpunit
```

PHP CS Fixer :
```bash
php vendor/bin/php-cs-fixer fix
```

Database :
```bash
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate --no-interaction
symfony console doctrine:fixtures:load
```