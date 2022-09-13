<?php

namespace Src\Lib;

class BancoDeDados {

    private static \PDO $conexao;
    private static \PDOStatement $resultado;

    public function executaSql(string $sql): bool {
        try {
            BancoDeDados::$conexao->beginTransaction();
            BancoDeDados::$resultado = BancoDeDados::$conexao->prepare($sql);
            BancoDeDados::$resultado->execute();
            BancoDeDados::$conexao->commit();
            return true;
        } catch (\Exception $ex) {
            echo "Falha ao executar o sql: " .
            $ex->getMessage();
            BancoDeDados::$conexao->rollBack();
            return false;
        }
    }

    public static function abrirConexao(
            string $url, string $login, string $senha
    ): bool {
        try {
            $configuracao = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND =>
                "set names utf8"
            );
            BancoDeDados::$conexao = new
                    \PDO(
                    $url, $login,
                    $senha, $configuracao
            );
            return true;
        } catch (\Exception $ex) {
            echo "Falha ao conectar "
            . "no banco de dados " .
            $ex->getMessage();
            exit(0);
        }

        return false;
    }

    public static function ler(
            \Src\Model\IBancoDeDados $entidade
    ) {
        $sql = "Select " .
                implode(",", $entidade->getCampos());
        $sql = $sql . " from " .
                get_class($entidade);

        if (BancoDeDados::abrirConexao(DB_URL, DB_LOGIN, DB_SENHA)) {
            BancoDeDados::executaSql($sql);
        }
        BancoDeDados::fecharConexao();
    }

    public static function fecharConexao() {
        BancoDeDados::$conexao = null;
    }

    public static function salvar(
            \Src\Model\IBancoDeDados $entidade
    ) {
        $sql = implode(",", $entidade->getCampos());
        $sql = "insert into Usuario(" . $sql . ")";
        $sql = $sql . "values('";
        $sql = $sql . implode("','", $entidade->getValores());
        $sql = $sql . "')";

        if (BancoDeDados::abrirConexao(DB_URL, DB_LOGIN, DB_SENHA)) {
            BancoDeDados::executaSql($sql);
        }
        BancoDeDados::fecharConexao();
    }

}
