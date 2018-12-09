<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

vscode + Laravel + Xampp

1. Put the file in the xampp\htdocs

2. Add the words in bottom of xampp\apache\conf\extra\httpd-vhosts.conf
<p>
//<VirtualHost *:80> <br>
    ServerName LaravelSimpleBlog <br>
    DocumentRoot "C:\xampp\htdocs\LaravelSimpleBlog\public"<br>
    ServerAdmin webmaster@LaravelSimpleBlog.test <br>
//</VirtualHost>
</p>
3. Add the words in bottom of C:\Windows\System32\drivers\etc\hosts

    127.0.0.1       LaravelSimpleBlog
    
    
