<?php
class Database {
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=api_jogos", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}

