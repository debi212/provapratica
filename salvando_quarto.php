<?php

require "verifica_login.php";
require "conexao.php";

$sql = "SELECT id_quarto, numero, tipo, capacidade, valor_diaria, status
        FROM quarto
        ORDER BY numero";

$result = $conn->query($sql);

if (!$result) {
    die("Erro ao buscar quartos: " . $conn->error);
}

?>

<h2>Lista de quartos</h2>

<a href="novo_quarto.php">Novo quarto</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>Número</th>
        <th>Tipo</th>
        <th>Capacidade</th>
        <th>Valor da diária</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while ($quarto = $result->fetch_assoc()): ?>

        <tr>
            <td><?= htmlspecialchars($quarto['numero']) ?></td>

            <td><?= htmlspecialchars($quarto['tipo']) ?></td>

            <td><?= $quarto['capacidade'] ?></td>

            <td>
                R$ <?= number_format($quarto['valor_diaria'], 2, ',', '.') ?>
            </td>

            <td><?= htmlspecialchars($quarto['status']) ?></td>

            <td>
                <a href="editar_quarto.php?id=<?= $quarto['id_quarto'] ?>">
                    Editar
                </a>

                |

                <a
                    href="excluir_quarto.php?id=<?= $quarto['id_quarto'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este quarto?');"
                >
                    Excluir
                </a>
            </td>
        </tr>

    <?php endwhile; ?>

</table>
