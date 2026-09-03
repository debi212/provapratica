<?php 
require "verifica_login.php"; 
require "conexao.php";
 $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
   $telefone = $_POST['telefone'];
    $email = $_POST['email']; 
    $endereco = $_POST['endereco']; 
    $sql = 
    "INSERT INTO hospede
     (nome,cpf,telefone,email,endereco) 
     VALUES (?,?,?,?,?)"; 
     $stmt = 
     $conn->prepare($sql);
     $stmt->bind_param( 
        "sssss", 
        $nome, 
        $cpf, 
        $telefone, 
        $email, 
        $endereco
         );
          $stmt->execute();
           header( 
            "Location: hospedes.php" );  
            ?> 