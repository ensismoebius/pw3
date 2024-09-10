<?php

namespace Etec\Aula02\Model;

class BancoDeDados
{
    private \PDO $conexao;
    private \PDOStatement $resultado;

    public function abrirConexao(string $usuario, string $senha, string $url): bool
    {

        try {
            $configuracao = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
            );

            $this->conexao = new \PDO($url, $usuario, $senha, $configuracao);
            return true;
        } catch (\Exception $erro) {
            echo "Falha ao conectar no banco de dados " . $erro->getMessage();
            exit(0);
        }

        return false;
    }

    public function fecharConexao(): bool
    {
        unset($this->conexao);
        return true;
    }

    public function lerResultado(string $classe)
    {
        return $this->resultado->fetchAll(\PDO::FETCH_CLASS, $classe);
    }


    public function executaSql(string $sql): bool
    {
        try {
            $this->conexao->beginTransaction();
            $this->resultado = $this->conexao->prepare($sql);
            $this->resultado->execute();
            $this->conexao->commit();
            return true;
        } catch (\Exception $ex) {
            echo "Falha ao executar o sql: " . $ex->getMessage();
            $this->conexao->rollBack();
            return false;
        }
    }

}
