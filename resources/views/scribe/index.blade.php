<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Caixa eletrônico</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                            <a href="#" data-language-name="php">php</a>
                            <a href="#" data-language-name="python">python</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: December 1 2020</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>Documentação da API Caixa eletrônico. Esta API não usa autenticação.</p>
<aside>Conforme você for rolando a página, irá ver exemplos de código de como utilizar esta API em algumas linguagens de programação (exibido no canto direito, escuro dessa página).
Você poderá selecionar a linguagem no canto superior direito desta tela.</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre><h1>Authenticating requests</h1>
<p>This API is not authenticated.</p><h1>Contas bancárias</h1>
<p>API para gerenciar contas de usuários</p>
<h2>Listar</h2>
<p>Lista as contas do usuário informado.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/doloribus/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/doloribus/accounts"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/users/doloribus/accounts',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">
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
]</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
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
<h2>Criar</h2>
<p>Cria uma conta para o usuário informado.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/et/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"tipo":"poupan\u00e7a","saldo":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/et/accounts"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

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
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/users/et/accounts',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
        'json' =&gt; [
            'tipo' =&gt; 'poupança',
            'saldo' =&gt; 500,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 5,
    "message": "Conta criada com sucesso."
}</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Example response (400, account_type_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Tipo de conta não encontrado."
}</code></pre>
<blockquote>
<p>Example response (400, user_has_account):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "O usuário já possui uma conta do tipo informado"
}</code></pre>
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
<h2>Listar</h2>
<p>Lista as contas do usuário informado.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/aut/accounts/accusamus?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/aut/accounts/accusamus"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/users/aut/accounts/accusamus',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">
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
]</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
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
<h2>Depositar</h2>
<p>Realiza o depósito do valor informado na conta informada.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/et/accounts/mollitia/deposit?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/et/accounts/mollitia/deposit"
);

let params = {
    "user_id": "1",
    "account_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

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
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/users/et/accounts/mollitia/deposit',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
            'account_id'=&gt; '1',
        ],
        'json' =&gt; [
            'valor' =&gt; 500,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
}</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Example response (400, account_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Conta não encontrada."
}</code></pre>
<blockquote>
<p>Example response (503, account_busy):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Caixa ocupado, por favor tente mais tarde"
}</code></pre>
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
<h2>Sacar</h2>
<p>Realiza o saque do valor informado na conta informada.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/laudantium/accounts/quis/withdraw?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/laudantium/accounts/quis/withdraw"
);

let params = {
    "user_id": "1",
    "account_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

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
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/users/laudantium/accounts/quis/withdraw',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
            'account_id'=&gt; '1',
        ],
        'json' =&gt; [
            'valor' =&gt; 500,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Saque no valor de R$ 500,00 efetuado com sucesso."
}</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Example response (400, account_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Conta não encontrada."
}</code></pre>
<blockquote>
<p>Example response (400, transaction_type_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Erro. Tipo de transação não encontrada."
}</code></pre>
<blockquote>
<p>Example response (400, insuficient_funds):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Você não tem saldo suficiente para este saque"
}</code></pre>
<blockquote>
<p>Example response (400, wrong_amount):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100"
}</code></pre>
<blockquote>
<p>Example response (503, account_busy):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Caixa ocupado, por favor tente mais tarde"
}</code></pre>
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
<h2>Consultar extrato</h2>
<p>Consulta o extrato da conta informada</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/et/accounts/officia/statement?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/et/accounts/officia/statement"
);

let params = {
    "user_id": "1",
    "account_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/users/et/accounts/officia/statement',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
            'account_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, success):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "oi"
}</code></pre>
<blockquote>
<p>Example response (400, user_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Example response (400, account_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Conta não encontrada."
}</code></pre>
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
</form><h1>Usuários</h1>
<p>API para gerenciar usuários</p>
<h2>Listar usuários</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/users',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/users'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
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
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Connection.php",
            "line": 339,
            "function": "run",
            "class": "Illuminate\\Database\\Connection",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2260,
            "function": "select",
            "class": "Illuminate\\Database\\Connection",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2248,
            "function": "runSelect",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2743,
            "function": "Illuminate\\Database\\Query\\{closure}",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2249,
            "function": "onceWithColumns",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2359,
            "function": "get",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Query\/Builder.php",
            "line": 2318,
            "function": "runPaginationCountQuery",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Builder.php",
            "line": 731,
            "function": "getCountForPagination",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/support\/Traits\/ForwardsCalls.php",
            "line": 23,
            "function": "paginate",
            "class": "Illuminate\\Database\\Eloquent\\Builder",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Model.php",
            "line": 1736,
            "function": "forwardCallTo",
            "class": "Illuminate\\Database\\Eloquent\\Model",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/database\/Eloquent\/Model.php",
            "line": 1748,
            "function": "__call",
            "class": "Illuminate\\Database\\Eloquent\\Model",
            "type": "-&gt;"
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
            "type": "-&gt;"
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
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 352,
            "function": "callControllerCallable",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 326,
            "function": "callLumenController",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 279,
            "function": "callControllerAction",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 264,
            "function": "callActionOnArrayBasedRoute",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 166,
            "function": "handleFoundRoute",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 426,
            "function": "Laravel\\Lumen\\Concerns\\{closure}",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 172,
            "function": "sendThroughPipeline",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Concerns\/RoutesRequests.php",
            "line": 92,
            "function": "dispatch",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 333,
            "function": "handle",
            "class": "Laravel\\Lumen\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/container\/BoundMethod.php",
            "line": 36,
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "-&gt;"
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
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 258,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/console\/Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 920,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 266,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/symfony\/console\/Application.php",
            "line": 142,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/illuminate\/console\/Application.php",
            "line": 93,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/vendor\/laravel\/lumen-framework\/src\/Console\/Kernel.php",
            "line": 116,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "-&gt;"
        },
        {
            "file": "\/var\/www\/html\/app\/artisan",
            "line": 35,
            "function": "handle",
            "class": "Laravel\\Lumen\\Console\\Kernel",
            "type": "-&gt;"
        }
    ]
}</code></pre>
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
<h2>Criar um usuário</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Andr\u00e9","cpf":"959.357.500-66","data_nascimento":"01\/01\/2001"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/users',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'nome' =&gt; 'André',
            'cpf' =&gt; '959.357.500-66',
            'data_nascimento' =&gt; '01/01/2001',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 4,
    "message": "Usuário criado com sucesso."
}</code></pre>
<blockquote>
<p>Example response (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado"
}</code></pre>
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
<h2>Buscar um usuário específico</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/quia?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/quia"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/users/quia',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
{
 "id": 4,
}</code></pre>
<blockquote>
<p>Example response (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado"
}</code></pre>
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
<h2>Editar um usuário específico</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/users/eveniet?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/eveniet"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/users/eveniet',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
{
 "user": 4,
 "message": "Usuário editado com sucesso",
}</code></pre>
<blockquote>
<p>Example response (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado"
}</code></pre>
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
<h2>Deleta um usuário específico</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "http://localhost/api/v1/users/aut?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/aut"
);

let params = {
    "user_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost/api/v1/users/aut',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
{
 "message": "Usuário removido com sucesso",
}</code></pre>
<blockquote>
<p>Example response (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado"
}</code></pre>
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
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                                    <a href="#" data-language-name="python">python</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var languages = ["bash","javascript","php","python"];
        setupLanguages(languages);
    });
</script>
</body>
</html>