# Contas bancárias

API para gerenciar contas de usuários

## Listar


Lista as contas de um usuário.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/dignissimos/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/dignissimos/accounts"
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
    'http://localhost/api/v1/users/dignissimos/accounts',
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

url = 'http://localhost/api/v1/users/dignissimos/accounts'
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

[
    {
        "id": 1,
        "user_id": 1,
        "account_type_id": 1,
        "saldo": 50,
        "tipo": "corrente",
    },
    {
        "id": 2,
        "user_id": 1,
        "account_type_id": 2,
        "saldo": 50,
        "tipo": "poupança",
    }
]
```
> Example response (404, Usuário não encontrado):

```json

{
    "error": [
        "code": 404,
        "message": "Usuário não encontrado"
    ]
}
```
<div id="execution-results-GETapi-v1-users--user_id--accounts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-users--user_id--accounts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--user_id--accounts"></code></pre>
</div>
<div id="execution-error-GETapi-v1-users--user_id--accounts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--user_id--accounts"></code></pre>
</div>
<form id="form-GETapi-v1-users--user_id--accounts" data-method="GET" data-path="api/v1/users/{user_id}/accounts" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--user_id--accounts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/users/{user_id}/accounts</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts" data-component="query" required  hidden>
<br>
Código do usuário</p>
</form>


## Criar


Cria uma conta para o usuário informado com um saldo inicial. Tipos aceitos: "corrente" e "poupança".

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/impedit/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"tipo":"poupan\u00e7a","saldo":500}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/impedit/accounts"
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
    "tipo": "poupan\u00e7a",
    "saldo": 500
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
    'http://localhost/api/v1/users/impedit/accounts',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
        ],
        'json' => [
            'tipo' => 'poupança',
            'saldo' => 500,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/impedit/accounts'
payload = {
    "tipo": "poupan\u00e7a",
    "saldo": 500
}
params = {
  'user_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload, params=params)
response.json()
```


> Example response (200, Sucesso):

```json
{
    "id": 5,
    "message": "Conta criada com sucesso."
}
```
> Example response (422, Dados inválidos):

```json

{
    "error": [
        "code": 422,
        "message": [
            "tipo": [
                "O campo tipo é obrigatório."
            ]
        ]
    ]
}
```
> Example response (404, Usuário não encontrado):

```json

{
    "error": [
        "code": 404,
        "message": "Usuário não encontrado"
    ]
}
```
> Example response (400, Tipo de conta inválido):

```json

{
    "error": [
        "code": 400,
        "message": "Tipo de conta inválido."
    ]
}
```
> Example response (409, Usuário já possui conta deste tipo):

```json

{
    "error": [
        "code": 409,
        "message": "O usuário já possui uma conta do tipo informado."
    ]
}
```
<div id="execution-results-POSTapi-v1-users--user_id--accounts" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-users--user_id--accounts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users--user_id--accounts"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-users--user_id--accounts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users--user_id--accounts"></code></pre>
</div>
<form id="form-POSTapi-v1-users--user_id--accounts" data-method="POST" data-path="api/v1/users/{user_id}/accounts" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users--user_id--accounts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/users/{user_id}/accounts</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts" data-component="query" required  hidden>
<br>
Código do usuário</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>tipo</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="tipo" data-endpoint="POSTapi-v1-users--user_id--accounts" data-component="body" required  hidden>
<br>
Tipo da conta (corrente ou poupança).</p>
<p>
<b><code>saldo</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="saldo" data-endpoint="POSTapi-v1-users--user_id--accounts" data-component="body"  hidden>
<br>
Saldo inicial da conta, somente valores positivos, se omitido será 0.</p>

</form>


## Depositar


Realiza o depósito de um determinado valor na conta de um usuário.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/aut/accounts/occaecati/deposit?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/aut/accounts/occaecati/deposit"
);

let params = {
    "user_id": "1",
    "account_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "valor": 500
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
    'http://localhost/api/v1/users/aut/accounts/occaecati/deposit',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
            'account_id'=> '1',
        ],
        'json' => [
            'valor' => 500,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/aut/accounts/occaecati/deposit'
payload = {
    "valor": 500
}
params = {
  'user_id': '1',
  'account_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload, params=params)
response.json()
```


> Example response (200, Sucesso):

```json
{
    "saldo": 50,
    "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
}
```
> Example response (422, Dados inválidos):

```json

{
    "error": [
        "code": 422,
        "message": [
            "valor": [
                "O campo valor é obrigatório."
            ]
        ]
    ]
}
```
> Example response (404, Usuário não encontrado):

```json

{
    "error": [
        "code": 404,
        "message": "Usuário não encontrado"
    ]
}
```
> Example response (404, Conta não encontrada):

```json

{
    "error": [
        "code": 404,
        "message": "Conta não encontrada."
    ]
}
```
> Example response (500, Tipo de transação não encontrada):

```json

{
    "error": [
        "code": 500,
        "message": "Tipo de transação não encontrada."
    ]
}
```
> Example response (503, Caixa ocupado):

```json

{
    "error": [
        "code": 503,
        "message": "Caixa ocupado, por favor tente mais tarde."
    ]
}
```
<div id="execution-results-POSTapi-v1-users--user_id--accounts--account_id--deposit" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-users--user_id--accounts--account_id--deposit"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users--user_id--accounts--account_id--deposit"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-users--user_id--accounts--account_id--deposit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users--user_id--accounts--account_id--deposit"></code></pre>
</div>
<form id="form-POSTapi-v1-users--user_id--accounts--account_id--deposit" data-method="POST" data-path="api/v1/users/{user_id}/accounts/{account_id}/deposit" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users--user_id--accounts--account_id--deposit', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/users/{user_id}/accounts/{account_id}/deposit</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--deposit" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="account_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--deposit" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--deposit" data-component="query" required  hidden>
<br>
Código do usuário</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="account_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--deposit" data-component="query" required  hidden>
<br>
Código da conta do usuário</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>valor</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="valor" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--deposit" data-component="body" required  hidden>
<br>
Valor do depósito.</p>

</form>


## Sacar


Realiza o saque de um determinado valor na conta de um usuário, e retorna o saldo e
a quantidade de cada nota que deve retornar

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/et/accounts/ad/withdraw?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":150}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/et/accounts/ad/withdraw"
);

let params = {
    "user_id": "1",
    "account_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "valor": 150
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
    'http://localhost/api/v1/users/et/accounts/ad/withdraw',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
            'account_id'=> '1',
        ],
        'json' => [
            'valor' => 150,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/et/accounts/ad/withdraw'
payload = {
    "valor": 150
}
params = {
  'user_id': '1',
  'account_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload, params=params)
response.json()
```


> Example response (200, Sucesso):

```json

{
    "notas" => [
       "100": 1,
       "50": 1,
       "20": 0
    ],
    "saldo": 50,
    "message": "Saque no valor de R$ 150,00 efetuado com sucesso."
}
```
> Example response (404, Usuário não encontrado):

```json

{
    "error": [
        "code": 404,
        "message": "Usuário não encontrado"
    ]
}
```
> Example response (404, Conta não encontrada):

```json

{
    "error": [
        "code": 404,
        "message": "Conta não encontrada."
    ]
}
```
> Example response (500, Tipo de transação não encontrada):

```json

{
    "error": [
        "code": 500,
        "message": "Tipo de transação não encontrada."
    ]
}
```
> Example response (400, Saldo insuficiente):

```json

{
    "error": [
        "code": 400,
        "message": "Você não tem saldo suficiente para este saque."
    ]
}
```
> Example response (400, Valor incorreto para saque):

```json

{
    "error": [
        "code": 400,
        "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100."
    ]
}
```
> Example response (503, Caixa ocupado):

```json

{
    "error": [
        "code": 503,
        "message": "Caixa ocupado, por favor tente mais tarde."
    ]
}
```
<div id="execution-results-POSTapi-v1-users--user_id--accounts--account_id--withdraw" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-users--user_id--accounts--account_id--withdraw"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users--user_id--accounts--account_id--withdraw"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-users--user_id--accounts--account_id--withdraw" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users--user_id--accounts--account_id--withdraw"></code></pre>
</div>
<form id="form-POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-method="POST" data-path="api/v1/users/{user_id}/accounts/{account_id}/withdraw" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users--user_id--accounts--account_id--withdraw', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/users/{user_id}/accounts/{account_id}/withdraw</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="account_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-component="query" required  hidden>
<br>
Código do usuário</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="account_id" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-component="query" required  hidden>
<br>
Código da conta do usuário</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>valor</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="valor" data-endpoint="POSTapi-v1-users--user_id--accounts--account_id--withdraw" data-component="body" required  hidden>
<br>
Valor do saque.</p>

</form>


## Consultar extrato


Consulta o extrato da conta de um usuário.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/omnis/accounts/provident/statement?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/omnis/accounts/provident/statement"
);

let params = {
    "user_id": "1",
    "account_id": "1",
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
    'http://localhost/api/v1/users/omnis/accounts/provident/statement',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'user_id'=> '1',
            'account_id'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/users/omnis/accounts/provident/statement'
params = {
  'user_id': '1',
  'account_id': '1',
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
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "account_id": 1,
            "transaction_type_id": 1,
            "created_at": "2020-12-02T02:07:02.000000Z",
            "updated_at": "2020-12-02T02:07:02.000000Z",
            "valor": 50,
            "tipo": "Depósito"
        },
        {
            "id": 2,
            "account_id": 1,
            "transaction_type_id": 1,
            "created_at": "2020-12-02T02:07:07.000000Z",
            "updated_at": "2020-12-02T02:07:07.000000Z",
            "valor": 50,
            "tipo": "Depósito"
        },
    ],
    "first_page_url": "http://localhost/api/v1/users/1/accounts/1/statement?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost/api/v1/users/1/accounts/1/statement?page=1",
    "next_page_url": null,
    "path": "http://localhost/api/v1/users/1/accounts/1/statement",
    "per_page": 50,
    "prev_page_url": null,
    "to": 20,
    "total": 20
}
```
> Example response (404, Usuário não encontrado):

```json

{
    "error": [
        "code": 404,
        "message": "Usuário não encontrado"
    ]
}
```
> Example response (404, Conta não encontrada):

```json

{
    "error": [
        "code": 404,
        "message": "Conta não encontrada."
    ]
}
```
<div id="execution-results-GETapi-v1-users--user_id--accounts--account_id--statement" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-users--user_id--accounts--account_id--statement"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--user_id--accounts--account_id--statement"></code></pre>
</div>
<div id="execution-error-GETapi-v1-users--user_id--accounts--account_id--statement" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--user_id--accounts--account_id--statement"></code></pre>
</div>
<form id="form-GETapi-v1-users--user_id--accounts--account_id--statement" data-method="GET" data-path="api/v1/users/{user_id}/accounts/{account_id}/statement" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--user_id--accounts--account_id--statement', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/users/{user_id}/accounts/{account_id}/statement</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id--statement" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="account_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id--statement" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id--statement" data-component="query" required  hidden>
<br>
Código do usuário</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="account_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id--statement" data-component="query" required  hidden>
<br>
Código da conta do usuário</p>
</form>



