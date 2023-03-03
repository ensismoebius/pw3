<?php

namespace Src\Controller;

class Comum {

    public function salvarMensagem($dados) {
        var_dump($dados);
    }

    public function entreEmContato() {
        $carregador = new \Twig\Loader\FilesystemLoader("./Src/View");
        $ambiente = new \Twig\Environment($carregador);

        $dados = array(
            "titulo" => "Envie sua phophoca",
            "url" => URL . "/contato"
        );

        echo $ambiente->render("entreEmContato.html", $dados);
    }

    public function principal() {
        $carregador = new \Twig\Loader\FilesystemLoader("./Src/View");
        $ambiente = new \Twig\Environment($carregador);

        $dados = array(
            "manchete" => "Pego roubando cobre",
            "titulo" => "Diário do Phila",
            "noticia" => "BOMBA!!!1111 Descoberta a verdadeira fonte de renda!"
        );

        echo $ambiente->render("principal.html", $dados);
    }

}
