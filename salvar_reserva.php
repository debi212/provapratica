<?php

require "verifica_login.php";
require "conexao.php";

$hospede = intval($_POST['hospede'] ?? 0);
$quarto = intval($_POST['quarto'] ?? 0);
$entrada = $_POST['entrada'] ?? '';
$saida = $_POST['saida'] ?? '';

if ($hospede <= 0 || $quarto <= 0 || $entrada === '' || $saida === '') {
    die("Dados da reserva inválidos.");
}

if ($saida <= $entrada) {
    die("A data de saída deve ser posterior à data de entrada.");
}

/* Verificar disponibilidade */
$stmt = $conn->prepare(
    "SELECT status FROM quarto WHERE id_quarto = ?"
);

$stmt->bind_param("i", $quarto);
$stmt->execute();

$q = $stmt->get_result()->fetch_assoc();

if (!$q) {
    die("Quarto não encontrado.");
}

if ($q['status'] != 'Disponível') {
    die("Quarto indisponível.");
}

/* Criar reserva */
$stmt = $conn->prepare(
    "INSERT INTO reserva
    (id_hospede, id_quarto, data_entrada, data_saida, status)
    VALUES (?, ?, ?, ?, 'Reservada')"
);

$stmt->bind_param(
    "iiss",
    $hospede,
    $quarto,
    $entrada,
    $saida
);

if (!$stmt->execute()) {
    die("Erro ao criar reserva: " . $stmt->error);
}

/* Alterar quarto para reservado */
$stmt = $conn->prepare(
    "UPDATE quarto
     SET status = 'Reservado'
     WHERE id_quarto = ?"
);

$stmt->bind_param("i", $quarto);

if (!$stmt->execute()) {
    die("Reserva criada, mas não foi possível atualizar o quarto.");
}

$stmt->close();

header("Location: reservas.php");
exit;
?>
