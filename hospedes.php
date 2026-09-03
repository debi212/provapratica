<?php 
 require "verifica_login.php"; 
 require "conexao.php";  
 $busca = 
 $_GET['busca'] ?? ''; 
  if($busca != ''){ 
         $termo =     "%".$busca."%"; 
         $sql =    
          "SELECT *     
        FROM hospede    
        WHERE nome LIKE ?    
        OR cpf LIKE ?    
        ORDER BY nome";      
        $stmt =   
          $conn->prepare($sql);
            $stmt->bind_param(    
                "ss",      
                $termo, 
                 $termo     
                 );     
                 $stmt->execute(); 
                $resultado =   
                $stmt->get_result();  
                }else{  
                     $resultado =  
                    $conn->query(     
                    "SELECT *      
                    FROM hospede      
                    ORDER BY nome"     
                    );  
                    }
                      ?>  
                      <h1>Hóspedes</h1> 
                       <a href="novo_hospede.php">
                        Novo hóspede 
                        </a>  
                        <br><br> 
                        <form method="GET"> 
                        <input type="text
                        " name="busca" 
                        placeholder="Nome ou CPF"> 
                        <button> Pesquisar 
                        </button>
                         </form> 
                         <br> 
                         <table border="1">
                          <tr> 
                          <th>Código</th> 
                          <th>Nome</th> 
                          <th>CPF</th> 
                          <th>Telefone</th> 
                          <th>Ações</th> 
                          </tr> 
                          <?php while( 
                            $h = $resultado->fetch_assoc() 
                            ){ 
                            ?> 
                            <tr> 
                            <td>
                            <?= $h['id_hospede'] ?>
                             </td> 
                             <td>
                              <?= htmlspecialchars($h['nome']) ?>
                               </td> 
                               <td> 
                               <?= htmlspecialchars($h['cpf']) ?> 
                               </td> 
                               <td> 
                               <?= htmlspecialchars($h['telefone']) ?>
                                </td> 
                                <td>
                                 <a href= "editar_hospede.php?id= <?= $h['id_hospede'] ?>">
                                  Editar </a>
                                   | <a href= "excluir_hospede.php?id=
                                    <?= $h['id_hospede'] ?>"
                                     onclick= 
                                     "return confirm('Excluir hóspede?')">
                                      Excluir 
                                      </a> 
                                      </td> 
                                      </tr>
                                       <?php } ?> 
                                       </table> 
                                       <br> 
                                       <a href="dashboard.php"> 
                                       Voltar
                                        </a> 