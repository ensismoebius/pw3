<?php

namespace Src\Controller;

class Comum {

    public function entreEmContato() {
        echo "Contato";
    }

    public function principal() {
        echo "Principal";
//        $carregador = new \Twig\Loader\FilesystemLoader("./Src/View");
//        $ambiente = new \Twig\Environment($carregador);

//        echo $ambiente->render("principal.html");
    }

}
