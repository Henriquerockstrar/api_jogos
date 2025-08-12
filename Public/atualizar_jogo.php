<?php
require_once __DIR__ . '/../Config/Database.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$nome = $input['nome'] ?? null;
$genero = $input['genero'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['erro' => 'ID do jogo é obrigatório']);
    exit;
}

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
    http_response_code(400);
    echo json_encode(['erro' => 'Nenhum campo para atualizar']);
    exit;
}

try {
    $conn = Database::connect();

    $sql = "UPDATE jogos SET " . implode(', ', $campos) . " WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    echo json_encode(['mensagem' => 'Jogo atualizado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao atualizar jogo', 'detalhe' => $e->getMessage()]);
}
