# Contas bancárias

API para gerenciar contas de usuários

## Listar


Lista as contas do usuário informado.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/doloribus/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/doloribus/accounts"
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
    'http://localhost/api/v1/users/doloribus/accounts',
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

url = 'http://localhost/api/v1/users/doloribus/accounts'
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


> Example response (200, success):

```json

[
    {
        "id": 1
        "user_id": 1
        "account_type_id": 1
        "saldo": 50
        "tipo": "corrente"
    },
    {
        "id": 2
        "user_id": 1
        "account_type_id": 2
        "saldo": 50
        "tipo": "poupança"
    }
]
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
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


Cria uma conta para o usuário informado.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/et/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"tipo":"poupan\u00e7a","saldo":500}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/et/accounts"
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
    'http://localhost/api/v1/users/et/accounts',
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

url = 'http://localhost/api/v1/users/et/accounts'
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


> Example response (200, success):

```json
{
    "id": 5,
    "message": "Conta criada com sucesso."
}
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
}
```
> Example response (400, account_type_not_found):

```json
{
    "message": "Tipo de conta não encontrado."
}
```
> Example response (400, user_has_account):

```json
{
    "message": "O usuário já possui uma conta do tipo informado"
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
<b><code>saldo</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="saldo" data-endpoint="POSTapi-v1-users--user_id--accounts" data-component="body" required  hidden>
<br>
Saldo inicial da conta.</p>

</form>


## Listar


Lista as contas do usuário informado.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/aut/accounts/accusamus?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/aut/accounts/accusamus"
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
    'http://localhost/api/v1/users/aut/accounts/accusamus',
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

url = 'http://localhost/api/v1/users/aut/accounts/accusamus'
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


> Example response (200, success):

```json

[
    {
        "id": 1
        "user_id": 1
        "account_type_id": 1
        "saldo": 50
        "tipo": "corrente"
    },
    {
        "id": 2
        "user_id": 1
        "account_type_id": 2
        "saldo": 50
        "tipo": "poupança"
    }
]
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
}
```
<div id="execution-results-GETapi-v1-users--user_id--accounts--account_id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-users--user_id--accounts--account_id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--user_id--accounts--account_id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-users--user_id--accounts--account_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--user_id--accounts--account_id-"></code></pre>
</div>
<form id="form-GETapi-v1-users--user_id--accounts--account_id-" data-method="GET" data-path="api/v1/users/{user_id}/accounts/{account_id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--user_id--accounts--account_id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/users/{user_id}/accounts/{account_id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>account_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="account_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="user_id" data-endpoint="GETapi-v1-users--user_id--accounts--account_id-" data-component="query" required  hidden>
<br>
Código do usuário</p>
</form>


## Depositar


Realiza o depósito do valor informado na conta informada.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/et/accounts/mollitia/deposit?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/et/accounts/mollitia/deposit"
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
    'http://localhost/api/v1/users/et/accounts/mollitia/deposit',
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

url = 'http://localhost/api/v1/users/et/accounts/mollitia/deposit'
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


> Example response (200, success):

```json
{
    "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
}
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
}
```
> Example response (400, account_not_found):

```json
{
    "message": "Conta não encontrada."
}
```
> Example response (503, account_busy):

```json
{
    "message": "Caixa ocupado, por favor tente mais tarde"
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


Realiza o saque do valor informado na conta informada.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/laudantium/accounts/quis/withdraw?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/laudantium/accounts/quis/withdraw"
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
    'http://localhost/api/v1/users/laudantium/accounts/quis/withdraw',
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

url = 'http://localhost/api/v1/users/laudantium/accounts/quis/withdraw'
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


> Example response (200, success):

```json
{
    "message": "Saque no valor de R$ 500,00 efetuado com sucesso."
}
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
}
```
> Example response (400, account_not_found):

```json
{
    "message": "Conta não encontrada."
}
```
> Example response (400, transaction_type_not_found):

```json
{
    "message": "Erro. Tipo de transação não encontrada."
}
```
> Example response (400, insuficient_funds):

```json
{
    "message": "Você não tem saldo suficiente para este saque"
}
```
> Example response (400, wrong_amount):

```json
{
    "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100"
}
```
> Example response (503, account_busy):

```json
{
    "message": "Caixa ocupado, por favor tente mais tarde"
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


Consulta o extrato da conta informada

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/et/accounts/officia/statement?user_id=1&account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/et/accounts/officia/statement"
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
    'http://localhost/api/v1/users/et/accounts/officia/statement',
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

url = 'http://localhost/api/v1/users/et/accounts/officia/statement'
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


> Example response (200, success):

```json
{
    "message": "oi"
}
```
> Example response (400, user_not_found):

```json
{
    "message": "Usuário não encontrado."
}
```
> Example response (400, account_not_found):

```json
{
    "message": "Conta não encontrada."
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



