# App-entregas
## Encontrando pessoas que possam entregar suas coisas

Projeto desenvolvido web desenvolvido com Bootstrap-alpha-4
  download em [Getbootstrap](https://v4-alpha.getbootstrap.com/getting-started/download/)

### Hosts e servidores
- O site em questão é hospedado em (http://app-entrega.azurewebsites.net)
- O banco de dados será armazeado também no Azure, porém é necessário um aplicativo SGBD para realizar as transações.
 
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

Sass
1. No terminal do C9 instale o Ruby
 ```bash
 sudo apt-get install ruby
 ```
2. Agora instale o Sass
```bash
 gem install sass
```
3. Agora vá até sua pasta onde guardará os arquivos CSS
```bash 
cd app/view/assets/css
```
4. Criando um arquivo .scss ou .sass e o arquivo css
```bash
sass --watch entrada.scss:saida.css
```


https://www.binpress.com/tutorial/php-bootstrapping-crash-course/146