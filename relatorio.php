<?php

require "verifica_login.php";
require "conexao.php";

/* Total de hóspedes */
$resultado = $conn->query(
    "SELECT COUNT(*) AS total FROM hospede"
);

$totalHospedes = $resultado->fetch_assoc()['total'];

/* Total de quartos */
$resultado = $conn->query(
    "SELECT COUNT(*) AS total FROM quarto"
);

$totalQuartos = $resultado->fetch_assoc()['total'];

/* Quartos disponíveis */
$resultado = $conn->query(
    "SELECT COUNT(*) AS total
     FROM quarto
     WHERE status = 'Disponível'"
);

$disponiveis = $resultado->fetch_assoc()['total'];

/* Quartos ocupados */
$resultado = $conn->query(
    "SELECT COUNT(*) AS total
     FROM quarto
     WHERE status = 'Ocupado'"
);

$ocupados = $resultado->fetch_assoc()['total'];

/* Quartos reservados */
$resultado = $conn->query(
    "SELECT COUNT(*) AS total
     FROM quarto
     WHERE status = 'Reservado'"
);

$reservados = $resultado->fetch_assoc()['total'];

?>

<h1>HotelSys — Relatório</h1>

<p>
    Hóspedes cadastrados:
    <strong><?= $totalHospedes ?></strong>
</p>

<p>
    Total de quartos:
    <strong><?= $totalQuartos ?></strong>
</p>

<p>
    Disponíveis:
    <strong><?= $disponiveis ?></strong>
</p>

<p>
    Ocupados:
    <strong><?= $ocupados ?></strong>
</p>

<p>
    Reservados:
    <strong><?= $reservados ?></strong>
</p>
