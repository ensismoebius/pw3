<?php

namespace Src\Controller;

class Admin {

    public function exibirLogin(array $param) {
        $carregador = new \Twig\Loader\FilesystemLoader("./Src/View");
        $ambiente = new \Twig\Environment($carregador);

        // Exibe a pagina construida
        //echo $ambiente->render("/html/index.html", $param);
        $param["titulo"] = "Cadastro de usuário";
        $param["destino"] = URL . "/admin/salvar";
        $param["bootstrapPath"] = "View/bootStrap.css";

        echo $ambiente->render("AdminExibirLogin.html", $param);
    }
    
    public function salvarLogin(array $param) {
        $u = new \Src\Model\Usuarie(
                $param["login"],
                $param["senha"]
        );
        
        \Src\Lib\BancoDeDados::salvar($u);
        
    }

}
