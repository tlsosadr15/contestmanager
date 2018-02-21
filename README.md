# ContestManager

[![Build Status](https://travis-ci.org/GuillaumeTorres/contestmanager.svg?branch=master)](https://travis-ci.org/GuillaumeTorres/contestmanager)
[![Code Climate](https://codeclimate.com/github/GuillaumeTorres/contestmanager/badges/gpa.svg)](https://codeclimate.com/github/GuillaumeTorres/contestmanager)
[![Issue Count](https://codeclimate.com/github/GuillaumeTorres/contestmanager/badges/issue_count.svg)](https://codeclimate.com/github/GuillaumeTorres/contestmanager)
[![Test Coverage](https://codeclimate.com/github/GuillaumeTorres/contestmanager/badges/coverage.svg)](https://codeclimate.com/github/GuillaumeTorres/contestmanager/coverage)

### Github app ###
 
```
https://github.com/GuillaumeTorres/contestmanagerapp
```

## Installation ##

```
composer install
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console assets:install
 ```

### Commandes utiles ###

```
php app/console doctrine:database:drop --force
php app/console doctrine:fixtures:load --no-interaction
php app/console cache:clear [--env=prod]
```

### Configuration host

```
 <VirtualHost *:80>
    ServerName contestmanager.dev
    DocumentRoot C:\wamp\www\contestmanager\web
    SetEnv APPLICATION_ENV "development"
    <Directory C:\wamp\www\contestmanager\web>
        DirectoryIndex app_dev.php
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

### .htaccess

Changer app_dev.php par app.php pour passer en production
```
DirectoryIndex app_dev.php
<IfModule mod_rewrite.c>
    RewriteEngine On

    RewriteCond %{REQUEST_URI}::$1 ^(/.+)/(.*)::\2$
    RewriteRule ^(.*) - [E=BASE:%1]

    RewriteCond %{ENV:REDIRECT_STATUS} ^$
    RewriteRule ^app\.php(/(.*)|$) %{ENV:BASE}/$2 [R=301,L]
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule .? - [L]

    RewriteRule .? %{ENV:BASE}/app_dev.php [L]
</IfModule>
<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /app_dev.php/
    </IfModule>
</IfModule>
```
