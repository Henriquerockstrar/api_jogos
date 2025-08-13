<?php
class Database {
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=api_jogos;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}

