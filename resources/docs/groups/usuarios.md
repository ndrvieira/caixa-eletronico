# Usuários

API para gerenciar usuários

## Listar


Lista todos os usuários cadastrados no sistema

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


> Example response (200, Sucesso):

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
> Example response (422, Dados inválidos):

```json

{
    "error": [
        "code": 422,
        "message": [
            "nome": [
                "O campo nome é obrigatório."
            ]
        ]
    ]
}
```
> Example response (409, CPF existente):

```json

{
    "error": [
        "code": 409,
        "message": "O CPF informado já foi registrado em outro usuário."
    ]
}
```
> Example response (500, Erro na aplicação):

```json

{
    "error": [
        "code": 500,
        "message": "Erro ao cadastrar usuário"
    ]
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
    "id": 1,
    "cpf": "306.045.290-31",
    "created_at": "2020-12-02T01:39:47.000000Z",
    "updated_at": "2020-12-02T01:39:47.000000Z",
    "nome": "André",
    "data_nascimento": "01\/01\/1992"
}
```
> Example response (400, Usuário não encontrado):

```json

{
    "error": [
        "code": 400,
        "message": "Usuário não encontrado"
    ]
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

> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/users/labore?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Andr\u00e9","data_nascimento":"01\/01\/2001"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/labore"
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

let body = {
    "nome": "Andr\u00e9",
    "data_nascimento": "01\/01\/2001"
}

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://localhost/api/v1/users/labore',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
        ],
        'json' => [
            'nome' => 'André',
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

url = 'http://localhost/api/v1/users/labore'
payload = {
    "nome": "Andr\u00e9",
    "data_nascimento": "01\/01\/2001"
}
params = {
  'user_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers, json=payload, params=params)
response.json()
```


> Example response (200, Sucesso):

```json

{
    "user": {
       "id": 1,
       "cpf": "306.045.290-31",
       "nome": "André",
       "data_nascimento": "01/01/1992"
    },
    "message": "Usuário editado com sucesso",
}
```
> Example response (422, Dados inválidos):

```json

{
    "error": [
        "code": 422,
        "message": [
            "data_nascimento": [
                "A data informada para o campo data nascimento não respeita o formato d/m/Y."
            ]
        ]
    ]
}
```
> Example response (400, Usuário não encontrado):

```json

{
    "error": [
        "code": 400,
        "message": "Usuário não encontrado"
    ]
}
```
> Example response (500, Erro na aplicação):

```json

{
    "error": [
        "code": 500,
        "message": "Erro ao editar usuário"
    ]
}
```
<div id="execution-results-PATCHapi-v1-users--user_id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PATCHapi-v1-users--user_id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-users--user_id-"></code></pre>
</div>
<div id="execution-error-PATCHapi-v1-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-users--user_id-"></code></pre>
</div>
<form id="form-PATCHapi-v1-users--user_id-" data-method="PATCH" data-path="api/v1/users/{user_id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-users--user_id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>api/v1/users/{user_id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="PATCHapi-v1-users--user_id-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="PATCHapi-v1-users--user_id-" data-component="query" required  hidden>
<br>
Código do usuário.</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>nome</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="nome" data-endpoint="PATCHapi-v1-users--user_id-" data-component="body"  hidden>
<br>
Nome do usuário.</p>
<p>
<b><code>data_nascimento</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="data_nascimento" data-endpoint="PATCHapi-v1-users--user_id-" data-component="body"  hidden>
<br>
Data no formato: d/m/Y.</p>

</form>


## Deletar


Deleta um usuário do sistema

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/users/expedita?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/expedita"
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
    'http://localhost/api/v1/users/expedita',
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

url = 'http://localhost/api/v1/users/expedita'
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
    "error": [
        "code": 400,
        "message": "Usuário não encontrado"
    ]
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



