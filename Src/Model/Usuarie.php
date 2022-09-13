<?php

namespace Src\Model;

class Usuarie implements IBancoDeDados {

    private string $login;
    private string $senha;

    public function __construct(
            string $login, string $senha
    ) {
        $this->login = $login;
        $this->senha = $senha;
    }

    public function getCampos(): array {
        return array("login", "senha");
    }

    public function getValores(): array {
        return array($this->login, $this->senha);
    }

}
