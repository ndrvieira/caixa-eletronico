# Caixa Eletrônico

Simulador de caixa eletrônico.

## Como instalar o projeto

#### Clone o projeto e depois entre em sua pasta:
`git clone git@github.com:ndrvieira/caixa-eletronico.git`
<br/>
<br/>
#### Suba o docker:
`docker-compose up -d`
<br/>
<br/>
#### Instalando dependências e rodando migration:
Na pasta do projeto, rode:
<br/>
`docker-compose exec php /bin/sh`
<br/>
Navegue até a pasta principal:
<br/>
`cd ../`
<br/>
Instale as dependências:
<br/>
`composer install`
<br/>
Rode a migration:
<br/>
`php artisan migrate --seed`
<br/>
<br/>
<br/>
*OBS: A documentação está na raiz do projeto.*
<br/>
*OBS2: Em caso de erro de conexão com o mysql, é possível que ele ainda esteja iniciando.*

## License

[MIT license](https://opensource.org/licenses/MIT).
