<?php

include './Src/Lib/vendor/autoload.php';

// Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

// Informa o diretorio onde os controladores se encontram
$roteador->namespace("Src\Controller");

/*
 *  Rota principal
 */
$roteador->group(null);
$roteador->get("/contato/{gerente}", "Comum:entreEmContato");
$roteador->get("/", "Comum:principal");
$roteador->get("/contato", "Comum:entreEmContato");

$roteador->group("admin");
$roteador->get("/login", "Admin:exibirLogin");
$roteador->get("/login2", "Admin:exibirLogin2");
$roteador->post("/salvar", "Admin:salvarLogin");

$roteador->dispatch();

//var_dump($roteador->error());
