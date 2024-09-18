<?php

namespace Etec\Aula02\Model;

class Funcionario
{
    public int $id;
    public string $nome;
    public string $sobrenome;

    public string $login;

    public string $senha;

    public function salvar(): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "insert into funcionario (nome, sobrenome, login, senha) values ";
        $sql = $sql . "('{$this->nome}','{$this->sobrenome}','{$this->login}','{$this->senha}')";

        return $bd->executaSql($sql);
    }

    public function atualizar(): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "update funcionario ";
        $sql .= "set nome = '{$this->nome}', 
        sobrenome = '{$this->sobrenome}', 
        login = '{$this->login}', 
        senha = '{$this->senha}'";

        $sql .= " where id = {$this->id}";

        return $bd->executaSql($sql);
    }


    public static function carregarTodos(): array
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "select * from funcionario";

        if ($bd->executaSql($sql)) {
            return $bd->lerResultado(self::class);
        }

        return [];
    }

    public function carregar(int $id): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "select * from funcionario ";
        $sql .= " where id = {$id}";

        if ($bd->executaSql($sql)) {
            $lista = $bd->lerResultado(self::class);

            if (count($lista) > 0) {
                foreach ($lista[0] as $propriedade => $valor) {
                    $this->$propriedade = $valor;
                }
            }
            return true;
        }
        return false;
    }

    public function apagar(): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "delete from funcionario where id = {$this->id}";

        return $bd->executaSql($sql);
    }

    public function carregarAutenticacao(string $login, string $senha): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "select * from funcionario ";
        $sql .= " where login = '{$login}' and senha = '{$senha}'";

        if ($bd->executaSql($sql)) {
            $lista = $bd->lerResultado(self::class);

            if (count($lista) > 0) {
                foreach ($lista[0] as $propriedade => $valor) {
                    $this->$propriedade = $valor;
                }
            }
            return true;
        }
        return false;
    }



}
