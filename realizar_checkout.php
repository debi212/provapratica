<?php

require "verifica_login.php";
require "conexao.php";

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    die("Reserva inválida.");
}

/* Buscar reserva e quarto */
$stmt = $conn->prepare("
    SELECT
        r.*,
        q.numero,
        q.valor_diaria
    FROM reserva r
    INNER JOIN quarto q
        ON r.id_quarto = q.id_quarto
    WHERE r.id_reserva = ?
      AND r.status = 'Hospedado'
");

$stmt->bind_param("i", $id);
$stmt->execute();

$r = $stmt->get_result()->fetch_assoc();

if (!$r) {
    die("Reserva não encontrada ou o hóspede não está hospedado.");
}

/* Calcular dias */
$entrada = new DateTime($r['data_entrada']);
$saida = new DateTime($r['data_saida']);

$diferenca = $entrada->diff($saida);
$dias = $diferenca->days;

if ($dias < 1) {
    $dias = 1;
}

/* Calcular total */
$total = $dias * $r['valor_diaria'];

/* Iniciar transação */
$conn->begin_transaction();

try {

    /* Finalizar reserva */
    $stmt = $conn->prepare("
        UPDATE reserva
        SET status = 'Finalizada'
        WHERE id_reserva = ?
          AND status = 'Hospedado'
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows !== 1) {
        throw new Exception("Não foi possível finalizar a reserva.");
    }

    /* Liberar quarto */
    $stmt = $conn->prepare("
        UPDATE quarto
        SET status = 'Disponível'
        WHERE id_quarto = ?
          AND status = 'Ocupado'
    ");

    $stmt->bind_param("i", $r['id_quarto']);
    $stmt->execute();

    if ($stmt->affected_rows !== 1) {
        throw new Exception("Não foi possível liberar o quarto.");
    }

    /* Confirmar alterações */
    $conn->commit();

} catch (Exception $e) {

    /* Desfazer alterações em caso de erro */
    $conn->rollback();

    die("Erro ao realizar check-out: " . $e->getMessage());
}

?>

<h1>Check-out realizado</h1>

<p>
    Quarto:
    <strong><?= htmlspecialchars($r['numero']) ?></strong>
</p>

<p>
    Quantidade de diárias:
    <strong><?= $dias ?></strong>
</p>

<p>
    Valor da diária:
    <strong>
        R$ <?= number_format($r['valor_diaria'], 2, ',', '.') ?>
    </strong>
</p>

<h2>
    Total: R$ <?= number_format($total, 2, ',', '.') ?>
</h2>

<a href="dashboard.php">
    Voltar ao Dashboard
</a>
