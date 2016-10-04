# ContestManager

[![build status](https://gitlab.com/GuillaumeTorres/contestmanager/badges/master/build.svg)](https://gitlab.com/GuillaumeTorres/contestmanager/commits/master)

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
