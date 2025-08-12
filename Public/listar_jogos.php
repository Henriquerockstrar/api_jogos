<?php
require_once __DIR__ . '/../Config/Database.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

try {
    $conn = Database::connect();

    $sql = "SELECT * FROM jogos";
    $stmt = $conn->query($sql);
    $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($jogos);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao listar jogos', 'detalhe' => $e->getMessage()]);
}
