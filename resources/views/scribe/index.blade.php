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
            <li>Last updated: December 3 2020</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introdução</h1>
<p>Documentação da API Caixa eletrônico.</p>
<aside>Conforme você for rolando a página, irá ver exemplos de código de como utilizar esta API em algumas linguagens de programação (exibido no canto direito, escuro dessa página).
Você poderá selecionar a linguagem no canto superior direito desta tela, para ter exemplos de requisições.</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre><h1>Autenticação</h1>
<p>Essa API não utiliza autenticação.</p><h1>Contas bancárias</h1>
<p>API para gerenciar contas de usuários</p>
<h2>Listar</h2>
<p>Lista as contas de um usuário.</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/corporis/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/corporis/accounts"
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
    'http://localhost/api/v1/users/corporis/accounts',
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

url = 'http://localhost/api/v1/users/corporis/accounts'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
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
]</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
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
<p>Cria uma conta para o usuário informado com um saldo inicial. Tipos aceitos: &quot;corrente&quot; e &quot;poupança&quot;.</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/at/accounts?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"tipo":"poupan\u00e7a","saldo":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/at/accounts"
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
    'http://localhost/api/v1/users/at/accounts',
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

url = 'http://localhost/api/v1/users/at/accounts'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 5,
    "message": "Conta criada com sucesso."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Tipo de conta inexistente):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Tipo de conta não encontrado."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário já possui conta):</p>
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
Saldo inicial da conta, somente valores positivos.</p>

</form>
<h2>Listar</h2>
<p>Lista as contas de um usuário.</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/nemo/accounts/aut?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/nemo/accounts/aut"
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
    'http://localhost/api/v1/users/nemo/accounts/aut',
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

url = 'http://localhost/api/v1/users/nemo/accounts/aut'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
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
]</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
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
<p>Realiza o depósito de um determinado valor na conta de um usuário.</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/voluptatem/accounts/accusamus/deposit?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/voluptatem/accounts/accusamus/deposit"
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
    'http://localhost/api/v1/users/voluptatem/accounts/accusamus/deposit',
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

url = 'http://localhost/api/v1/users/voluptatem/accounts/accusamus/deposit'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">{
    "saldo": 50,
    "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Conta não encontrada):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Conta não encontrada."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (503, Caixa ocupado):</p>
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
<p>Realiza o saque de um determinado valor na conta de um usuário, e retorna o saldo e
a quantidade de cada nota que deve retornar</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/users/tempore/accounts/maxime/withdraw?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valor":500}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/tempore/accounts/maxime/withdraw"
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
    'http://localhost/api/v1/users/tempore/accounts/maxime/withdraw',
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

url = 'http://localhost/api/v1/users/tempore/accounts/maxime/withdraw'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
{
    "notas" =&gt; [
       "100": 1,
       "50": 1,
       "20": 0
    ],
    "saldo": 50,
    "message": "Saque no valor de R$ 500,00 efetuado com sucesso."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Conta Não encontrada):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Conta não encontrada."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, transaction_type_not_found):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Erro. Tipo de transação não encontrada."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, insuficient_funds):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Você não tem saldo suficiente para este saque"
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, wrong_amount):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100"
}</code></pre>
<blockquote>
<p>Exemplo de resposta (503, Caixa ocupado):</p>
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
<p>Consulta o extrato da conta de um usuário.</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/magnam/accounts/aliquid/statement?user_id=1&amp;account_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/magnam/accounts/aliquid/statement"
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
    'http://localhost/api/v1/users/magnam/accounts/aliquid/statement',
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

url = 'http://localhost/api/v1/users/magnam/accounts/aliquid/statement'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
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
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Conta Não encontrada):</p>
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
<h2>Listar</h2>
<p>Lista todos os usuários cadastrados no sistema</p>
<blockquote>
<p>Exemplo de requisição:</p>
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
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
<h2>Criar</h2>
<p>Cria um usuário no sistema</p>
<blockquote>
<p>Exemplo de requisição:</p>
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 4,
    "message": "Usuário criado com sucesso."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Dados inválidos):</p>
</blockquote>
<pre><code class="language-json">{
    "cpf": [
        "O cpf informado é inválido."
    ]
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, CPF já existente):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "O CPF informado já foi registrado em outro usuário."
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Erro na aplicação):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Erro ao cadastrar usuário"
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
<h2>Buscar</h2>
<p>Busca um usuário específico no sistema através do seu id</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/users/ut?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/ut"
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
    'http://localhost/api/v1/users/ut',
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

url = 'http://localhost/api/v1/users/ut'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "cpf": "306.045.290-31",
    "created_at": "2020-12-02T01:39:47.000000Z",
    "updated_at": "2020-12-02T01:39:47.000000Z",
    "nome": "André",
    "data_nascimento": "01\/01\/1992"
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
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
Código do usuário.</p>
</form>
<h2>Editar</h2>
<p>Edita um usuário no sistema</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/users/sit?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/sit"
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
    'http://localhost/api/v1/users/sit',
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

url = 'http://localhost/api/v1/users/sit'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
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
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Usuário não encontrado"
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Dados inválidos):</p>
</blockquote>
<pre><code class="language-json">{
    "nome": [
        "O nome informado é inválido."
    ]
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Erro na aplicação):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Erro ao cadastrar usuário"
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
Código do usuário.</p>
</form>
<h2>Deletar</h2>
<p>Deleta um usuário do sistema</p>
<blockquote>
<p>Exemplo de requisição:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "http://localhost/api/v1/users/fugit?user_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/users/fugit"
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
    'http://localhost/api/v1/users/fugit',
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

url = 'http://localhost/api/v1/users/fugit'
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
<p>Exemplo de resposta (200, Sucesso):</p>
</blockquote>
<pre><code class="language-json">
{
    "message": "Usuário removido com sucesso",
}</code></pre>
<blockquote>
<p>Exemplo de resposta (400, Usuário não encontrado):</p>
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
Código do usuário.</p>
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