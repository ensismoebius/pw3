<?php
// Inclui de forma obrigatória 
// o arquivo no nosso código
require_once "bancoDeDados.php";

// Recupera o nome do formulário
$nome = $_POST["nome"];
// Recupera uma quantidade do formulário
$qtde = $_POST["quantidade"];

// Carrega um array
$dadosCarregados = carregar($qtde);

// Inicia uma lista
echo "<label>Nome: </label>". $nome . "</br>";
echo "<ul>";

foreach ($dadosCarregados as $indice => $valor) {
    // Imprime cada item da lista
    echo "<li>" . $indice . "-" . $valor."</li>";
}
echo "</ul>";

