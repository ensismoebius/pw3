<?php
require_once "bancoDeDados.php";

// Inicia a sessão criando cookies
// no cliente e no servidor:
// Cria os cookies no servidor e no
// cliente e também cria a variável
// super global $_SESSION
session_start();

// Inicializa o banco de dados
inicializar();

$operacao = $_POST["operacao"];

if($operacao == 0){
    $recebido = $_POST["fruta"];
    salvar($recebido);
}else{
    $codigo = $_POST["codigo"];
    apagar($codigo);
}

echo '<pre>';
var_dump($_SESSION["dados"]);
echo '</pre>';