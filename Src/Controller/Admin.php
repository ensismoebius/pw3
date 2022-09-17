<?php

namespace Src\Controller;

class Admin {

    public function exibirLogin2(array $param) {
        $carregador = new \Twig\Loader\FilesystemLoader(VIEWS_DIR);
        $ambiente = new \Twig\Environment($carregador);

        // Exibe a pagina construida
        $param["titulo"] = "Cadastro de usuário";
        $param["destino"] = URL . "/admin/salvar";

        // Adiciona os estilos
        $param["styles"][] = url(VIEWS_DIR . "/css/app.css");
        $param["styles"][] = url(VIEWS_DIR . "/css/reset.css");
        $param["styles"][] = url(VIEWS_DIR . "/css/teste.css");
        $param["styles"][] = url(VIEWS_DIR . "/css/responsivo.css");

        //Adiciona imagens
        $param["logo"] = url(VIEWS_DIR . "/imagens/logo.png");

        echo $ambiente->render("/html/index.html", $param);
    }

    public function exibirLogin(array $param) {
        $carregador = new \Twig\Loader\FilesystemLoader("./Src/View");
        $ambiente = new \Twig\Environment($carregador);

        // Exibe a pagina construida
        //echo $ambiente->render("/html/index.html", $param);
        $param["titulo"] = "Cadastro de usuário";
        $param["destino"] = URL . "/admin/salvar";
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
