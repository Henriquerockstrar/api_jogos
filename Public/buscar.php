<?php

require_once __DIR__ . '/../Model/jogos.php';

$jogo = new Jogo();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $resultado = $jogo->buscarPorId($id);
    if ($resultado) {
        echo json_encode($resultado);
    } else {
        http_response_code(404);
        echo json_encode(['erro' => 'Jogo não encontrado']);
    }
    exit;
}
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['genero'])) {
    $genero = $_GET['genero'];
    $resultado = $jogo->buscarPorGenero($genero);
    echo json_encode($resultado);
    exit;
}
