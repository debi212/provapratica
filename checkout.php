<?php

require "verifica_login.php";
require "conexao.php";

$resultado = $conn->query("
    SELECT
        r.id_reserva,
        h.nome,
        q.numero,
        q.valor_diaria,
        r.data_entrada,
        r.data_saida
    FROM reserva r
    INNER JOIN hospede h
        ON r.id_hospede = h.id_hospede
    INNER JOIN quarto q
        ON r.id_quarto = q.id_quarto
    WHERE r.status = 'Hospedado'
    ORDER BY r.data_saida
");

if (!$resultado) {
    die("Erro ao buscar hospedagens: " . $conn->error);
}

?>

<h1>Check-out</h1>

<table border="1">

    <tr>
        <th>Hóspede</th>
        <th>Quarto</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Ação</th>
    </tr>

    <?php while ($r = $resultado->fetch_assoc()) { ?>

        <tr>

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
                <a
                    href="realizar_checkout.php?id=<?= $r['id_reserva'] ?>"
                    onclick="return confirm('Deseja realmente realizar o check-out?');"
                >
                    Realizar check-out
                </a>
            </td>

        </tr>

    <?php } ?>

</table>
