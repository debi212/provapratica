<h2>Novo quarto</h2>

<form action="salvar_quarto.php" method="POST">

    <label for="numero">Número:</label>
    <input type="text" id="numero" name="numero" required>

    <br><br>

    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
        <option value="Standard">Standard</option>
        <option value="Luxo">Luxo</option>
        <option value="Suíte">Suíte</option>
        <option value="Executivo">Executivo</option>
    </select>

    <br><br>

    <label for="capacidade">Capacidade:</label>
    <input
        type="number"
        id="capacidade"
        name="capacidade"
        min="1"
        required
    >

    <br><br>

    <label for="valor">Valor da diária:</label>
    <input
        type="number"
        id="valor"
        name="valor"
        min="0"
        step="0.01"
        required
    >

    <br><br>

    <button type="submit">Cadastrar</button>

</form>
