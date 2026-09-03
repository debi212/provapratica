<?php

require "verifica_login.php";
require "conexao.php";

$id = intval($_POST['id'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');

if ($id <= 0 || $nome === '') {
    die("Dados inválidos.");
}

$stmt = $conn->prepare(
    "UPDATE hospede 
     SET nome = ?, cpf = ?, telefone = ?, email = ?, endereco = ?
     WHERE id_hospede = ?"
);

if (!$stmt) {
    die("Erro ao preparar a atualização: " . $conn->error);
}

$stmt->bind_param(
    "sssssi",
    $nome,
    $cpf,
    $telefone,
    $email,
    $endereco,
    $id
);

if (!$stmt->execute()) {
    die("Erro ao atualizar hóspede: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: hospedes.php");
exit;
?>
