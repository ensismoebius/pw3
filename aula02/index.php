<?php

require_once "vendor/autoload.php";

// Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

// Informa o diretorio onde os controladores se encontram
$roteador->namespace("\Etec\Aula02\Controller");

/*
 *  Rota principal
 */
$roteador->group(null); // Aponta para a raíz do site
$roteador->get("/", "Comum:inicial"); // Página inicial
$roteador->get("/sobre", "Comum:sobre"); // Sobre

// Precisa pra rota funcionar
$roteador->dispatch();
