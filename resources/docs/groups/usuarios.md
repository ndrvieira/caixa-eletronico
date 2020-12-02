# Usuários

API para gerenciar usuários

## Listar usuários




> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/users',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (500):

```json
{
    "message": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'lumen.users' doesn't exist (SQL: select count(*) as aggregate from `users`)",
    "exception": "Illuminate\\Database\\QueryException",
    "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Connection.php",
    "line": 671,
    "trace": [
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Connection.php",
            "line": 631,
            "function": "runQueryCallback",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Connection.php",
            "line": 339,
            "function": "run",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2260,
            "function": "select",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2248,
            "function": "runSelect",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2743,
            "function": "Illuminate\\Database\\Query\\{closure}",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2249,
            "function": "onceWithColumns",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2359,
            "function": "get",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2318,
            "function": "runPaginationCountQuery",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Builder.php",
            "line": 731,
            "function": "getCountForPagination",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/support\/Traits\/ForwardsCalls.php",
            "line": 23,
            "function": "paginate",
            "class": "Illuminate\\Database\\Eloquent\\Builder",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Model.php",
            "line": 1736,
            "function": "forwardCallTo",
            "class": "Illuminate\\Database\\Eloquent\\Model",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Model.php",
            "line": 1748,
            "function": "__call",
            "class": "Illuminate\\Database\\Eloquent\\Model",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/app\/Http\/Controllers\/UserController.php",
            "line": 24,
            "function": "__callStatic",
            "class": "Illuminate\\Database\\Eloquent\\Model",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 36,
            "function": "index",
            "class": "App\\Http\\Controllers\\UserController",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/Util.php",
            "line": 37,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 93,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 37,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/Container.php",
            "line": 596,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 386,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 352,
            "function": "callControllerCallable",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 326,
            "function": "callLumenController",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 279,
            "function": "callControllerAction",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 264,
            "function": "callActionOnArrayBasedRoute",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 166,
            "function": "handleFoundRoute",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 426,
            "function": "Laravel\\Lumen\\Concerns\\{closure}",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 172,
            "function": "sendThroughPipeline",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 92,
            "function": "dispatch",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 333,
            "function": "handle",
            "class": "Laravel\\Lumen\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 36,
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/Util.php",
            "line": 37,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 93,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 37,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/Container.php",
            "line": 596,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/console\/Command.php",
            "line": 134,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 258,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/console\/Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 920,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 266,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 142,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/console\/Application.php",
            "line": 93,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Console\/Kernel.php",
            "line": 116,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/var\/www\/html\/app\/artisan",
            "line": 35,
            "function": "handle",
            "class": "Laravel\\Lumen\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```
<div id="execution-results-GETapi-v1-users" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-users"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users"></code></pre>
</div>
<div id="execution-error-GETapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users"></code></pre>
</div>
<form id="form-GETapi-v1-users" data-method="GET" data-path="api/v1/users" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/users</code></b>
</p>
</form>


## Criar um usuário




> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Andr\u00e9","cpf":"959.357.500-66","data_nascimento":"01\/01\/2001"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nome": "Andr\u00e9",
    "cpf": "959.357.500-66",
    "data_nascimento": "01\/01\/2001"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/users',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'nome' => 'André',
            'cpf' => '959.357.500-66',
            'data_nascimento' => '01/01/2001',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users'
payload = {
    "nome": "Andr\u00e9",
    "cpf": "959.357.500-66",
    "data_nascimento": "01\/01\/2001"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (200, Sucesso):

```json
{
    "id": 4,
    "message": "Usuário criado com sucesso."
}
```
> Example response (400, Usuário não encontrado):

```json
{
    "message": "Usuário não encontrado"
}
```
<div id="execution-results-POSTapi-v1-users" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-users"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users"></code></pre>
</div>
<form id="form-POSTapi-v1-users" data-method="POST" data-path="api/v1/users" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/users</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>nome</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="nome" data-endpoint="POSTapi-v1-users" data-component="body" required  hidden>
<br>
Nome do usuário.</p>
<p>
<b><code>cpf</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="cpf" data-endpoint="POSTapi-v1-users" data-component="body" required  hidden>
<br>
CPF do usuário com pontuação.</p>
<p>
<b><code>data_nascimento</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="data_nascimento" data-endpoint="POSTapi-v1-users" data-component="body" required  hidden>
<br>
Data no formato: d/m/Y.</p>

</form>


## Buscar um usuário específico




> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/quia?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/quia"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/users/quia',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/quia'
params = {
  'user_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (200, Sucesso):

```json

{
 "id": 4,
}
```
> Example response (400, Usuário não encontrado):

```json
{
    "message": "Usuário não encontrado"
}
```
<div id="execution-results-GETapi-v1-users--user_id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-users--user_id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--user_id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--user_id-"></code></pre>
</div>
<form id="form-GETapi-v1-users--user_id-" data-method="GET" data-path="api/v1/users/{user_id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--user_id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/users/{user_id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="GETapi-v1-users--user_id-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="GETapi-v1-users--user_id-" data-component="query" required  hidden>
<br>
Código do usuário</p>
</form>


## Editar um usuário específico




> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/users/eveniet?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/eveniet"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/users/eveniet',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/eveniet'
params = {
  'user_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, params=params)
response.json()
```


> Example response (200, Sucesso):

```json

{
 "user": 4,
 "message": "Usuário editado com sucesso",
}
```
> Example response (400, Usuário não encontrado):

```json
{
    "message": "Usuário não encontrado"
}
```
<div id="execution-results-PUTapi-v1-users--user_id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-users--user_id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-users--user_id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-users--user_id-"></code></pre>
</div>
<form id="form-PUTapi-v1-users--user_id-" data-method="PUT" data-path="api/v1/users/{user_id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-users--user_id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/users/{user_id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="PUTapi-v1-users--user_id-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="PUTapi-v1-users--user_id-" data-component="query" required  hidden>
<br>
Código do usuário</p>
</form>


## Deleta um usuário específico




> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/users/aut?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/aut"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost/api/v1/users/aut',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/aut'
params = {
  'user_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers, params=params)
response.json()
```


> Example response (200, Sucesso):

```json

{
 "message": "Usuário removido com sucesso",
}
```
> Example response (400, Usuário não encontrado):

```json
{
    "message": "Usuário não encontrado"
}
```
<div id="execution-results-DELETEapi-v1-users--user_id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-users--user_id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-users--user_id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-users--user_id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-users--user_id-" data-method="DELETE" data-path="api/v1/users/{user_id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-users--user_id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/users/{user_id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="DELETEapi-v1-users--user_id-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="DELETEapi-v1-users--user_id-" data-component="query" required  hidden>
<br>
Código do usuário</p>
</form>



