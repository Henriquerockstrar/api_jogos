<?php
require_once __DIR__ . '/../Config/Database.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['erro' => 'ID do jogo é obrigatório']);
    exit;
}

try {
    $conn = Database::connect();

    $sql = "DELETE FROM jogos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo json_encode(['mensagem' => 'Jogo deletado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao deletar jogo', 'detalhe' => $e->getMessage()]);
}
