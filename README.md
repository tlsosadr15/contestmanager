# ContestManager

[![Build Status](https://travis-ci.org/GuillaumeTorres/contestmanager.svg?branch=master)](https://travis-ci.org/GuillaumeTorres/contestmanager)
[![Coverage Status](https://coveralls.io/repos/github/GuillaumeTorres/contestmanager/badge.svg?branch=master)](https://coveralls.io/github/GuillaumeTorres/contestmanager?branch=master)

### Github app ###
 
```
https://github.com/GuillaumeTorres/contestmanagerapp
```

## Installation ##

```
composer install
php app/console doctrine:database:create
php app/console doctrine:schema:update --force

php app/console doctrine:fixtures:load --no-interaction
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
