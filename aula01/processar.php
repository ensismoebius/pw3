<?php
$nomeRecuperadoDoFomulario = $_POST["nome"];
$quantidadeRecuperadaDoFormulario = $_POST["quantidade"];

while($quantidadeRecuperadaDoFormulario < 10){
    $quantidadeRecuperadaDoFormulario++;
    echo "Ajustando quantidade";
}

if($quantidadeRecuperadaDoFormulario < 10){
    $quantidadeRecuperadaDoFormulario = 10;
}

if($quantidadeRecuperadaDoFormulario >= 0){
    for($i=0; $i < $quantidadeRecuperadaDoFormulario; $i++){
        echo "Olá " . $nomeRecuperadoDoFomulario . PHP_EOL;
    }
}

switch ($nomeRecuperadoDoFomulario) {
    case 'Uga':
        echo "Capitão caverna";
        break;
    case 'Pedra':
        echo "Pedrita";
    default:
        echo "Desconhecido";
}

