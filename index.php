<?php
require './Src/Lib/vendor/autoload.php';

\Src\Lib\BancoDeDados::inicializar(DB_URL, DB_NAME, DB_LOGIN, DB_SENHA);

// Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

// Informa o diretorio onde os controladores se encontram
$roteador->namespace("Src\Controller");

/*
 *  Rota principal
 */
$roteador->group(null);
$roteador->get("/contato/{gerente}", "Comum:entreEmContato");
$roteador->get("/contato", "Comum:entreEmContato");

$roteador->post("/contato", "Comum:salvarMensagem");

$roteador->get("/", "Comum:principal");

$roteador->group("admin");
$roteador->get("/login", "Admin:exibirLogin");
$roteador->post("/salvar", "Admin:salvarLogin");
$roteador->get("/", "Admin:painel");

$roteador->dispatch();

//var_dump($roteador->error());