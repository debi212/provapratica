<?php

require "verifica_login.php";
require "conexao.php";

$sql = "
    SELECT
        r.id_reserva,
        h.nome,
        q.numero,
        r.data_entrada,
        r.data_saida,
        r.status
    FROM reserva r
    INNER JOIN hospede h
        ON r.id_hospede = h.id_hospede
    INNER JOIN quarto q
        ON r.id_quarto = q.id_quarto
    ORDER BY r.data_entrada
";

$resultado = $conn->query($sql);

if (!$resultado) {
    die("Erro ao listar reservas: " . $conn->error);
}

?>

<h1>Reservas</h1>

<a href="nova_reserva.php">Nova reserva</a>

<br><br>

<table border="1">

    <tr>
        <th>Reserva</th>
        <th>Hóspede</th>
        <th>Quarto</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Status</th>
    </tr>

    <?php while ($r = $resultado->fetch_assoc()) { ?>

        <tr>

            <td><?= $r['id_reserva'] ?></td>

            <td>
                <?= htmlspecialchars($r['nome']) ?>
            </td>

            <td>
                <?= htmlspecialchars($r['numero']) ?>
            </td>

            <td>
                <?= htmlspecialchars($r['data_entrada']) ?>
            </td>

            <td>
                <?= htmlspecialchars($r['data_saida']) ?>
            </td>

            <td>
                <?= htmlspecialchars($r['status']) ?>
            </td>

        </tr>

    <?php } ?>

</table>
