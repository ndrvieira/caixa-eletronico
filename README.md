# Caixa Eletrônico

Simulador de caixa eletrônico.

## Como instalar o projeto

#### Clone o projeto e depois entre em sua pasta:
`git clone git@github.com:ndrvieira/caixa-eletronico.git`
<br/>
<br/>
#### Suba o docker (Obs: O banco não está persistido):
`docker-compose up --build -d`
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
<br/>
*OBS3: Como o banco não está persistido, toda vez que derrubar o docker será necessário rodar o migrate.*

## License

[MIT license](https://opensource.org/licenses/MIT).
