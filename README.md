# Novis Hub

## Setting up (development)

``` bash
$ cp development.env.org development.env
```

Edit environment variables in `development.env`.

- `VIRTUAL_HOST`: Hostname to access from browser.
- `MYSQL_ROOT_PASSWORD`: Password which mysql container use for `root` user.


``` bash
$ docker-compose -f docker-compose.development.yml up
```

Build images and start containers for project.

``` bash
$ docker exec novis-hub-php-fpm composer install
```

Install php dependencies with composer.

``` bash
$ cat schema.sql | docker exec -i novis-hub-mysql-server mysql -uroot -ppassword
```

Create initial database and tables.
Make sure to replace `password` with your `MYSQL_ROOT_PASSWORD`.

