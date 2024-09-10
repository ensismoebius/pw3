<?php

namespace Etec\Aula02\Model;

class Funcionario
{
    public int $id;
    public string $nome;
    public string $sobrenome;

    public function salvar(): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "insert into funcionario (nome, sobrenome) values ";
        $sql = $sql . "('" . $this->nome . "','" . $this->sobrenome . "')";

        return $bd->executaSql($sql);
    }

    public function atualizar(): bool
    {
        $bd = new BancoDeDados();
        $bd->abrirConexao(USUARIO, SENHA, URL_BD);

        $sql = "update funcionario ";
        $sql .= "set nome = '{$this->nome}', sobrenome = '{$this->sobrenome}' ";
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

}
