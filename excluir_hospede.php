<?php

require "verifica_login.php";
require "conexao.php";

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    die("ID do hóspede inválido.");
}

$stmt = $conn->prepare(
    "DELETE FROM hospede WHERE id_hospede = ?"
);

if (!$stmt) {
    die("Erro ao preparar a exclusão: " . $conn->error);
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Erro ao excluir hóspede: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: hospedes.php");
exit;
?>
