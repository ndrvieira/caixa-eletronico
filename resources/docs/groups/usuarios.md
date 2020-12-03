# Usuários

API para gerenciar usuários

## Listar


Lista todos os usuários cadastrados no sistema

> Exemplo de requisição:

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


> Exemplo de resposta (200, Sucesso):

```json

{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "cpf": "306.045.290-31",
            "created_at": "2020-12-02T01:39:47.000000Z",
            "updated_at": "2020-12-02T01:39:47.000000Z",
            "nome": "André",
            "data_nascimento": "01/01/1992"
        },
        {
            "id": 2,
            "cpf": "148.078.190-89",
            "created_at": "2020-12-02T01:42:47.000000Z",
            "updated_at": "2020-12-02T01:42:47.000000Z",
            "nome": "Pedro",
            "data_nascimento": "01/01/1993"
        },
    ],
    "first_page_url": "http://localhost/api/v1/users?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost/api/v1/users?page=1",
    "next_page_url": null,
    "path": "http://localhost/api/v1/users",
    "per_page": 50,
    "prev_page_url": null,
    "to": 1,
    "total": 1
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


## Criar


Cria um usuário no sistema

> Exemplo de requisição:

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


> Exemplo de resposta (200, Sucesso):

```json
{
    "id": 4,
    "message": "Usuário criado com sucesso."
}
```
> Exemplo de resposta (400, Dados inválidos):

```json
{
    "cpf": [
        "O cpf informado é inválido."
    ]
}
```
> Exemplo de resposta (400, CPF já existente):

```json
{
    "message": "O CPF informado já foi registrado em outro usuário."
}
```
> Exemplo de resposta (400, Erro na aplicação):

```json
{
    "message": "Erro ao cadastrar usuário"
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


## Buscar


Busca um usuário específico no sistema através do seu id

> Exemplo de requisição:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/ut?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/ut"
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
    'http://localhost/api/v1/users/ut',
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

url = 'http://localhost/api/v1/users/ut'
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


> Exemplo de resposta (200, Sucesso):

```json
{
    "id": 1,
    "cpf": "306.045.290-31",
    "created_at": "2020-12-02T01:39:47.000000Z",
    "updated_at": "2020-12-02T01:39:47.000000Z",
    "nome": "André",
    "data_nascimento": "01\/01\/1992"
}
```
> Exemplo de resposta (400, Usuário não encontrado):

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
Código do usuário.</p>
</form>


## Editar


Edita um usuário no sistema

> Exemplo de requisição:

```bash
curl -X PUT \
    "http://localhost/api/v1/users/sit?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/sit"
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
    'http://localhost/api/v1/users/sit',
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

url = 'http://localhost/api/v1/users/sit'
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


> Exemplo de resposta (200, Sucesso):

```json

{
    "user": {
       "id": 1,
       "cpf": "306.045.290-31",
       "created_at": "2020-12-02T01:39:47.000000Z",
       "updated_at": "2020-12-02T01:39:47.000000Z",
       "nome": "André",
       "data_nascimento": "01/01/1992"
    },
    "message": "Usuário editado com sucesso",
}
```
> Exemplo de resposta (400, Usuário não encontrado):

```json
{
    "message": "Usuário não encontrado"
}
```
> Exemplo de resposta (400, Dados inválidos):

```json
{
    "nome": [
        "O nome informado é inválido."
    ]
}
```
> Exemplo de resposta (400, Erro na aplicação):

```json
{
    "message": "Erro ao cadastrar usuário"
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
Código do usuário.</p>
</form>


## Deletar


Deleta um usuário do sistema

> Exemplo de requisição:

```bash
curl -X DELETE \
    "http://localhost/api/v1/users/fugit?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/fugit"
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
    'http://localhost/api/v1/users/fugit',
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

url = 'http://localhost/api/v1/users/fugit'
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


> Exemplo de resposta (200, Sucesso):

```json

{
    "message": "Usuário removido com sucesso",
}
```
> Exemplo de resposta (400, Usuário não encontrado):

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
Código do usuário.</p>
</form>



