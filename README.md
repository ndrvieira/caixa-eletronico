# Caixa Eletrônico

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Como instalar o projeto

Clone o projeto e entre em sua pasta:
<br/>
`git clone git@github.com:ndrvieira/caixa-eletronico.git app`
<br/>
`cd app`
<br/>
<br/>
Suba o docker (Obs: O banco não está persistido):
<br/>
`docker-compose up --build -d`
<br/>
<br/>
Instalando dependências:
<br/>
`composer install` (Caso tenha o composer instalado)
<br/>
`docker run --rm --interactive --tty -v $PWD/:/app composer install` (Caso não tenha o composer)
<br/>
<br/>
Rodando migration (esperar um pouco até o mysql ligar):
<br/>
`docker-compose exec php /bin/sh`
<br/>
Navegue até a pasta principal:
<br/>
`cd ../`
<br/>
Rode a migration:
<br/>
`php artisan migrate --seed`
<br/>
<br/>
*OBS: A documentação está na raiz do projeto.*

## License

[MIT license](https://opensource.org/licenses/MIT).
