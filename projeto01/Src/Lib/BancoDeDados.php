<?php

namespace Src\Lib;

class BancoDeDados {

    public static \PDO $conn;
    public static string $host;
    public static string $username;
    public static string $password;
    public static string $database;

    public static function inicializar(string $host, string $db, string $usuario, string $senha): bool {
        $dsn = "mysql:host={$host};dbname={$db}";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            self::$conn = new \PDO($dsn, $usuario, $senha, $options);
        } catch (\PDOException $e) {
            die('Falha ao conectar ao banco');
        }
        
        return true;
    }

    public static function insert(string $tabela, $objeto): bool {
        $columns = [];
        $valores = [];

        foreach ($objeto as $indice => $valor) {
            $columns[] = $indice;
            $valores[] = $valor;
        }

        $columns = implode(',', $columns);
        $placeholders = rtrim(str_repeat('?,', count($valores)), ',');

        $sql = "INSERT INTO $tabela ($columns) VALUES ($placeholders)";
        $stmt = BancoDeDados::$conn->prepare($sql);

        if ($stmt->execute($valores)) {
            return true;
        } else {
            return false;
        }
    }

    public static function select(string $tabela, $condicoes = []): bool {
        $where = '';

        if (!empty($condicoes)) {
            $where = 'WHERE ';

            foreach ($condicoes as $indice => $valor) {
                $where .= "$indice = ? AND ";
            }

            $where = rtrim($where, ' AND ');
        }

        $sql = "SELECT * FROM $tabela $where";
        $stmt = BancoDeDados::$conn->prepare($sql);

        $valores = array_values($condicoes);
        $stmt->execute($valores);

        $rows = $stmt->fetchAll();

        return $rows;
    }

    public static function update(string $tabela, $objeto, $condicoes): bool {
        $set = [];

        foreach ($objeto as $indice => $valor) {
            $set[] = "$indice = ?";
        }

        $set = implode(',', $set);

        $where = [];

        foreach ($condicoes as $indice => $valor) {
            $where[] = "$indice = ?";
        }

        $where = implode(' AND ', $where);

        $sql = "UPDATE $tabela SET $set WHERE $where";
        $stmt = BancoDeDados::$conn->prepare($sql);

        $valores = array_merge(array_values($objeto), array_values($condicoes));

        if ($stmt->execute($valores)) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete(string $tabela, $condicoes): bool {
        $where = [];

        foreach ($condicoes as $indice => $valor) {
            $where[] = "$indice = ?";
        }

        $where = implode(' AND ', $where);

        $sql = "DELETE FROM $tabela WHERE $where";
        $stmt = BancoDeDados::$conn->prepare($sql);

        $valores = array_values($condicoes);

        if ($stmt->execute($valores)) {
            return true;
        } else {
            return false;
        }
    }

    public static function desconectar(): void {
        self::$conn = null;
    }

}
