<?php

namespace Etec\Aula02\Controller;

class Comum
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        $this->ambiente = new \Twig\Environment($this->carregador);
    }

    public function inicial($dados)
    {

        $listaDeOpcoes = array(
            "Batata",
            "Brócolis",
            "Alho assado",
            "Pão doce"
        );

        $info = array(
            "titulo" => "Caverna Corp",
            "mensagem" => "Nossa missão é ganhar dinheiro",
            "alimentos" => $listaDeOpcoes
        );

        // Exibe a pagina construida
        echo $this->ambiente->render("inicial.html", $info);
    }

    public function sobre($dados)
    {
        $lista = \Etec\Aula02\Model\Funcionario::carregarTodos();
        
        $info = array(
            "titulo" => "Caverna Corp",
            "mensagem" => "Nossa missão é ganhar dinheiro tirando o sangue de:",
            "funcionarios" => $lista
        );

        // Exibe a pagina construida
        echo $this->ambiente->render("sobre.html", $info);
    }
}
