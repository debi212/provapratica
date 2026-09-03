<?php

require "verifica_login.php";
require "conexao.php";

$resultado = $conn->query(
    "SELECT * FROM quarto ORDER BY numero"
);

if (!$resultado) {
    die("Erro ao listar quartos: " . $conn->error);
}

?>

<h1>Quartos</h1>

<a href="novo_quarto.php">Cadastrar quarto</a>

<br><br>

<table border="1">

    <tr>
        <th>Quarto</th>
        <th>Tipo</th>
        <th>Capacidade</th>
        <th>Diária</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while ($q = $resultado->fetch_assoc()) { ?>

        <tr>

            <td><?= htmlspecialchars($q['numero']) ?></td>

            <td><?= htmlspecialchars($q['tipo']) ?></td>

            <td><?= $q['capacidade'] ?></td>

            <td>
                R$ <?= number_format($q['valor_diaria'], 2, ',', '.') ?>
            </td>

            <td><?= htmlspecialchars($q['status']) ?></td>

            <td>
                <a href="editar_quarto.php?id=<?= $q['id_quarto'] ?>">
                    Editar
                </a>

                |

                <a
                    href="excluir_quarto.php?id=<?= $q['id_quarto'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este quarto?');"
                >
                    Excluir
                </a>
            </td>

        </tr>

    <?php } ?>

</table>
