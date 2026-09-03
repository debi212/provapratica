<?php 
session_start();
 if(isset($_SESSION['usuario'])){ 
    header("Location: dashboard.php"); 
    exit; 
    } ?> 
    <!DOCTYPE html> 
    <html lang="pt-br"> 
    <head> <meta charset="UTF-8"> 
    <title>HotelSys</title>
     </head> 
     <body>
      <h1>HotelSys</h1> 
      <h2>Login</h2>
       <form action="login.php" method="POST"> 
       <label>Usuário</label>
       <input 
       type="text" 
       name="login"
        required> 
        <br><br> 
        <label>Senha</label> 
        <input type="password"
         name="senha"
          required> 
          <br><br>   
    <button type="submit">
     Entrar 
     </button> 
     </form> 
     </body>
      </html> 