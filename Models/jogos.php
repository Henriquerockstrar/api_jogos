<?php
require_once __DIR__ . '/../Config/Database.php';

class Jogo {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM jogos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $genero = null) {
        $sql = "INSERT INTO jogos (nome, genero) VALUES (:nome, :genero)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nome' => $nome, ':genero' => $genero]);
    }

    public function atualizar($id, $nome = null, $genero = null) {
        $campos = [];
        $params = [':id' => $id];

        if ($nome !== null) {
            $campos[] = "nome = :nome";
            $params[':nome'] = $nome;
        }
        if ($genero !== null) {
            $campos[] = "genero = :genero";
            $params[':genero'] = $genero;
        }

        if (empty($campos)) {
            return false; // nada para atualizar
        }

        $sql = "UPDATE jogos SET " . implode(', ', $campos) . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function deletar($id) {
        $sql = "DELETE FROM jogos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
