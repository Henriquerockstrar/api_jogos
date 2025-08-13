<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once __DIR__ . '/../Model/jogos.php';

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['nome'])) {
    echo json_encode(["erro" => "Nome do jogo é obrigatório."]);
    exit;
}


$nome = $data['nome'];
$genero = isset($data['genero']) ? $data['genero'] : null;
$classificacao = isset($data['classificacao']) ? $data['classificacao'] : null;

$jogo = new Jogo();

if ($jogo->criar($nome, $genero, $classificacao)) {
    echo json_encode(["mensagem" => "Jogo criado com sucesso!"]);
} else {
    echo json_encode(["erro" => "Falha ao criar o jogo."]);
}
