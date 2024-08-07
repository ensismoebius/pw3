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

// Insere os dados
salvar(array("gato","cão","pão"));
salvar(array("um","dois","tres"));
salvar(array("capivara","pato","tato"));

// Apaga os dados
apagar(3);

// Mostra os dados
var_dump(carregar(0));
session_destroy();
