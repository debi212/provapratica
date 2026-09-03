<?php

require "verifica_login.php";
require "conexao.php";

$hospedes = $conn->query(
    "SELECT * FROM hospede ORDER BY nome"
);

$quartos = $conn->query(
    "SELECT * FROM quarto
     WHERE status = 'Disponível'
     ORDER BY numero"
);

?>

<h2>Nova reserva</h2>

<form action="salvar_reserva.php" method="POST">

    <label>Hóspede:</label>

    <select name="hospede" required>

        <option value="">Selecione o hóspede</option>

        <?php while ($h = $hospedes->fetch_assoc()) { ?>

            <option value="<?= $h['id_hospede'] ?>">
                <?= htmlspecialchars($h['nome']) ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Quarto:</label>

    <select name="quarto" required>

        <option value="">Selecione o quarto</option>

        <?php while ($q = $quartos->fetch_assoc()) { ?>

            <option value="<?= $q['id_quarto'] ?>">
                Quarto <?= htmlspecialchars($q['numero']) ?>
                - <?= htmlspecialchars($q['tipo']) ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Entrada:</label>
    <input type="date" name="entrada" required>

    <br><br>

    <label>Saída:</label>
    <input type="date" name="saida" required>

    <br><br>

    <button type="submit">Realizar reserva</button>

</form>
