# AppEntrega
App destinado a encontrar pessoas que podem entregar coisas para você,
torne-se um entregador e ganha uma renda extra.

## Linguagem
Esse aplicativo é desenvolvido usando PHP.
Com a framework [Laravel 5.4](https://laravel.com) 

## Instalação

No cloud9 será feito da seguinte forma
```bash
sudo apt-get update
sudo apt-get install libmcrypt-dev
```

Fazendo o download do phpbrew

```bash
curl -L -O https://github.com/phpbrew/phpbrew/raw/master/phpbrew
chmod +x phpbrew
sudo mv phpbrew /usr/local/bin/
phpbrew init

# add this to your ~/.bashrc:
[[ -e ~/.phpbrew/bashrc ]] && source ~/.phpbrew/bashrc

phpbrew lookup-prefix ubuntu
```

Quando terminar, hora de instalar o php, pode demorar um pouco

```bash
phpbrew install 7.0 +default
phpbrew switch php-7.0.17
phpbrew use php-7.0.17
php -v

PHP 7.0.17 (cli) (built: Apr  6 2017 12:43:11) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
```
E finalmente instale a extensão cURL, necessária para outras bibliotecas

```bash
phpbrew ext install curl
```

## Bibliotecas
1. O método de pagamento atual é feito pelo PagSeguro
Utilizando a solução Open-source [Michael Douglas/Laravel-pagseguro](https://github.com/michaeldouglas/laravel-pagseguro), 
seguir os passos de instalação no github.

2. Para facilitar o uso da API do Google Maps com o Laravel, usamos a seguinte solução Open-source
[Alex Pechkarev/Google-maps](https://github.com/alexpechkarev/google-maps), seguir os passos de instalação presentes no github.

>Hey Adilson é o Furukawa, então existe o GetNinjas, você pode se basear nele pra fazer as coisas (doc e funcionalidades), enfim (é só uma dica, exclui essa reposta depois :p )

--- 

## Hosts e servidores
- O site em questão é hospedado em (http://appentrega.herokuapp.com)
- Para fazer o deploy das atualizações, basta realizar os seguintes passos no terminal: 
```bash
git add .
git commit -m "mensagem do commit"
git push heroku master
```
 
## Banco de dados
A linguagem de banco de dados usada é MySQL, servidor de banco de dados usado é o Azure.
informações de conexão estão disponíveis no arquivo `.env` na raiz do projeto.

### Mais sobre MySQL
* Conectar MySQL no C9 - https://community.c9.io/t/connecting-php-to-mysql/1606

* Para usar MySQL na linha de comando, digitar no terminal:
 ```sh
mysql-ctl cli
```
* https://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17

* Um SGBD leve e simples [SQLEctron](https://github.com/sqlectron/sqlectron-gui/releases/tag/v1.20.2)


### Frameworks, bibliotecas e APIs
JQuery - adicione ao fim do body
```html
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
```

JQuery Mask - adicione ao fim do body, depois do jquery
```html
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
```

--- 

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- **[Codecourse](https://www.codecourse.com)**
- [Fragrantica](https://www.fragrantica.com)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
