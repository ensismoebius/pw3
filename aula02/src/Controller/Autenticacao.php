<?php

namespace Etec\Aula02\Controller;

class Autenticacao
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        $this->ambiente = new \Twig\Environment($this->carregador);
    }

    public function salvar($dados)
    {
        $f = new \Etec\Aula02\Model\Funcionario();

        $f->nome = $dados["nome"];
        $f->sobrenome = $dados["sobrenome"];
        $f->login = $dados["login"];
        $f->senha = $dados["senha"];

        if ($f->salvar()) {
            $this->ambiente->render(
                "login.html",
                array("mensagem" => "Login criado")
            );
        } else {
            $this->ambiente->render(
                "login.html",
                array("mensagem" => "Falha ao criar")
            );
        }
    }

    public function autenticar($dados): void
    {
        $login = $dados["login"];
        $senha = $dados["senha"];

        $f = new \Etec\Aula02\Model\Funcionario();
        
        if($f->carregarAutenticacao($login, $senha)){
            session_start();
            $_SESSION["id"] = $f->id;
            $_SESSION["nome"] = $f->nome;

            header("location: /");
        } else {
            $this->ambiente->render(
                "login.html",
                array("mensagem" => "Falha ao autenticar")
            );
        }
    }
}
