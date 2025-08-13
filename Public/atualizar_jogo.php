<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/../Model/jogos.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;
$nome = $data['nome'] ?? null;
$genero = $data['genero'] ?? null;
$classificacao = $data['classificacao'] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID é obrigatório para atualizar."]);
    exit;
}

$jogo = new jogo();
$resultado = $jogo->atualizar($id, $nome, $genero, $classificacao);

if ($resultado) {
    echo json_encode(["mensagem" => "Jogo atualizado com sucesso."]);
} else {
    echo json_encode(["erro" => "Nenhum dado enviado ou falha na atualização."]);
}
