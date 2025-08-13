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
    public function buscarPorId($id) {
    $sql = "SELECT * FROM jogos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
   public function buscarPorGenero($genero) {
        $sql = "SELECT * FROM jogos WHERE genero = :genero";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':genero' => $genero]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function criar($nome, $genero = null, $classificacao = null) {
        $sql = "INSERT INTO jogos (nome, genero, classificacao) VALUES (:nome, :genero, :classificacao)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':genero' => $genero,
            ':classificacao' => $classificacao
        ]);
    }

    public function atualizar($id, $nome = null, $genero = null, $classificacao = null) {
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
        if ($classificacao !== null) {
            $campos[] = "classificacao = :classificacao";
            $params[':classificacao'] = $classificacao;
        }

        if (empty($campos)) {
            return false; 
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
