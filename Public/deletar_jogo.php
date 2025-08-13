<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

require_once __DIR__ . '/../Model/jogos.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID é obrigatório para deletar."]);
    exit;
}

$jogo = new jogo();

if ($jogo->deletar($id)) {
    echo json_encode(["mensagem" => "Jogo deletado com sucesso."]);
} else {
    echo json_encode(["erro" => "Falha ao deletar o jogo."]);
}
