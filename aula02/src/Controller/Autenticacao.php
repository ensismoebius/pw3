<?php

namespace Etec\Aula02\Controller;

class Autenticacao extends Base
{
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
        session_start();
        if(isset($_SESSION["id"])){
            header("location: /");
            exit();
        }

        @$login = $dados["login"];
        @$senha = $dados["senha"];

        $f = new \Etec\Aula02\Model\Funcionario();
        
        if(
            !is_null($login) && 
            !is_null($senha) && 
            $f->carregarAutenticacao($login, $senha)
        ){
            $_SESSION["id"] = $f->id;
            $_SESSION["nome"] = $f->nome;

            header("location: /");
        } else {
            echo $this->ambiente->render(
                "login.html",
                array("mensagem" => "Falha ao autenticar")
            );
        }
    }
}
