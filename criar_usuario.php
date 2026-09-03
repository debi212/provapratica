<?php
 $conn = new mysqli( 
    "localhost", 
    "root", 
    "", 
    "hotel" );
     $nome = "Administrador"; 
     $login = "admin";
      $senha = password_hash( "1234", PASSWORD_DEFAULT );
     $sql = "INSERT INTO usuario
     (nome, login, senha, perfil)
      VALUES (?, ?, ?, 'Administrador')"; 
      $stmt = $conn->prepare($sql); 
      $stmt->bind_param( "sss",
       $nome, 
       $login,
       $senha ); 
      $stmt->execute(); 
      echo "Usuário criado com sucesso!"; 
      ?> 
