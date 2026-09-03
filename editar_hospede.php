<?php 
require "verifica_login.php";
 require "conexao.php";
  $id = 
  intval($_GET['id']); 
  $stmt = 
  $conn->prepare( 
    "SELECT * 
    FROM hospede 
    WHERE id_hospede=?"
     ); 
     $stmt->bind_param(
         "i", 
         $id 
         );
          $stmt->execute();
           $h =
            $stmt->get_result() 
            ->fetch_assoc(); 
            ?> 
            <h2>Editar hóspede</h2> 
            <form 
            action="atualizar_hospede.php"
             method="POST"> 
             <input 
             type="hidden" 
             name="id" 
             value="<?= $h['id_hospede'] ?>">
              Nome: 
              <input 
              name="nome" 
              value="<?= htmlspecialchars($h['nome']) ?>">
               <br><br> 
               CPF:
                <input 
                name="cpf" 
                value="<?= htmlspecialchars($h['cpf']) ?>"> 
                <br><br> 
                Telefone: 
                <input 
                name="telefone" 
                value="<?= htmlspecialchars($h['telefone']) ?>"> 
                <br><br>
                 Email: 
                 <input name="email"
                  value="<?= htmlspecialchars($h['email']) ?>"> 
                  <br><br> 
                  Endereço: 
                  <input name="endereco"
                   value="<?= htmlspecialchars($h['endereco']) ?>">
                    <br><br> 
                    <button>
                         Atualizar 
                        </button> 
                    </form> 