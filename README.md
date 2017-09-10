# eCom

Yet another shopping cart built in php

## Apache Notes
Since I have `public` (which is what is being served) and `resource` (all the configurations) dirs; your apache vhost config might look like this

```
# Ecom Website
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "/var/www/html/ecom/public"
    ServerName ecom.172.16.1.253.nip.io
    ServerAlias ecom.172.16.1.253.nip.io
    ErrorLog "logs/ecom-error_log"
    CustomLog "logs/ecom-access_log" common
</VirtualHost>

```
