# Caixa Eletrônico

Simulador de caixa eletrônico.

## Requisitos

*Git e Docker*

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
*OBS: A documentação está no endpoint de entrada "localhost", "/".*
<br/>
*OBS2: Em caso de erro de conexão com o mysql, é possível que ele ainda esteja iniciando.*

### Testes
Na raiz do projeto execute (Caso ainda esteja dentro do container do docker, pular este passo):
<br/>
`docker-compose exec php /bin/sh`
<br/>
Navegue até a pasta principal (Caso ainda esteja dentro do container do docker, pular este passo):
<br/>
`cd ../`
<br/>
Rode os testes:
<br/>
`./vendor/bin/phpunit`

## License

[MIT license](https://opensource.org/licenses/MIT).
