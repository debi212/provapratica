<?php

require "verifica_login.php";
require "conexao.php";

$id = intval($_POST['reserva'] ?? 0);

if ($id <= 0) {
    die("Reserva inválida.");
}

/* Descobrir o quarto da reserva */
$stmt = $conn->prepare(
    "SELECT id_quarto
     FROM reserva
     WHERE id_reserva = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$reserva = $stmt->get_result()->fetch_assoc();

if (!$reserva) {
    die("Reserva não encontrada.");
}

$id_quarto = $reserva['id_quarto'];

/* Atualizar reserva */
$stmt = $conn->prepare(
    "UPDATE reserva
     SET status = 'Hospedado'
     WHERE id_reserva = ?"
);

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Erro ao atualizar reserva: " . $stmt->error);
}

/* Atualizar quarto */
$stmt = $conn->prepare(
    "UPDATE quarto
     SET status = 'Ocupado'
     WHERE id_quarto = ?"
);

$stmt->bind_param("i", $id_quarto);

if (!$stmt->execute()) {
    die("Erro ao atualizar quarto: " . $stmt->error);
}

$stmt->close();

echo "Check-in realizado com sucesso.";

?>
