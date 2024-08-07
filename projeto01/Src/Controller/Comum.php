<?php

namespace Src\Controller;

class Comum {

    public function salvarMensagem($dados) {
        // Filtra o título
        $titulo = filter_var($dados['titulo'], FILTER_UNSAFE_RAW);
        // Filtra a fofoca
        $fofoca = filter_var($dados['fofoca'], FILTER_UNSAFE_RAW);
        // Valida telefone
        $telValido = filter_var($dados['telefone'], FILTER_VALIDATE_REGEXP,
                array("options" => array("regexp" => "/\(\d{2}\)\d{5}-\d{4}/"))
        );
        // Se o telefone é válido tenta salvar os dados já que a fofoca e o título 
        // já foram filtrados, mesmo assim verifica se o tamanho da fofoca e do titulo
        // é maior que zero
        if ($telValido && strlen(trim($fofoca)) > 0 && strlen(trim($titulo))) {
            $f = new \Src\Model\Fofoca();
            $f->fofoca = $fofoca;
            $f->titulo = $titulo;
            $f->telefone = $dados['telefone'];

            $resultado = \Src\Lib\BancoDeDados::salvar($f);
            if ($resultado) {
                echo "salvo com sucesso";
            } else {
                echo "falha ao salvar";
            }
        } else {
            echo "Formato de telefone errado, faça como o exemplo: (21)12534-5263";
        }
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
