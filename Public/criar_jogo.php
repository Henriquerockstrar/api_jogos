<?php
require_once __DIR__ . '/../Config/Database.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$nome = $input['nome'] ?? null;
$genero = $input['genero'] ?? null;

if (!$nome) {
    http_response_code(400);
    echo json_encode(['erro' => 'Nome do jogo é obrigatório']);
    exit;
}

try {
    $conn = Database::connect();

    $sql = "INSERT INTO jogos (nome, genero) VALUES (:nome, :genero)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':nome' => $nome, ':genero' => $genero]);

    echo json_encode(['mensagem' => 'Jogo criado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao criar jogo', 'detalhe' => $e->getMessage()]);
}
