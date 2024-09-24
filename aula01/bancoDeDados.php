<?php
// Mudei tudo pq tava ficando confuso

/**
 * Verifica se a posição "dados" 
 * existe na sessão
 * @return void
 */
function inicializar() : void {

    // Caso "dados" não exista dentro
    // de $_SESSION cria um conjunto
    // de dados
    if(!isset($_SESSION["dados"])){
    
        // Se existir popula com os dados iniciais 
        $_SESSION["dados"] = array(
            0 => array("Caverna", "Pedra", "fogo"),
            1 => array("Tesoura", "Papel", "Lagarto"),
            2 => array("sorvete","pirulito","diabete")
        );
    }
}

/**
 * Carrega um registro da "tabela"
 * @param int $id
 * @return array
 */
function carregar(int $id) : array {
    return $_SESSION["dados"][$id];
}

/**
 * Apaga uma linha 
 * @param int $id
 * @return void
 */
function apagar(int $id) : void{
    unset($_SESSION["dados"][$id]);
}

/**
 * Salva mais um registro na sessão
 * @param array $registro
 * @return void
 */
function salvar(array $registro) : void {
    $_SESSION["dados"][] = $registro;
}

