<?php

require "verifica_login.php";
require "conexao.php";

$reservas = $conn->query("
    SELECT
        r.id_reserva,
        h.nome,
        q.numero
    FROM reserva r
    INNER JOIN hospede h
        ON r.id_hospede = h.id_hospede
    INNER JOIN quarto q
        ON r.id_quarto = q.id_quarto
    WHERE r.status = 'Reservada'
    ORDER BY r.data_entrada
");

if (!$reservas) {
    die("Erro ao buscar reservas: " . $conn->error);
}

?>

<h1>Check-in</h1>

<form action="realizar_checkin.php" method="POST">

    <label for="reserva">Reserva:</label>

    <select name="reserva" id="reserva" required>

        <option value="">Selecione uma reserva</option>

        <?php while ($r = $reservas->fetch_assoc()) { ?>

            <option value="<?= $r['id_reserva'] ?>">
                <?= htmlspecialchars($r['nome']) ?>
                - Quarto <?= htmlspecialchars($r['numero']) ?>
            </option>

        <?php } ?>

    </select>

    <button type="submit">
        Realizar Check-in
    </button>

</form>
