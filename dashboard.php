<?php 
require "verifica_login.php"; 
require "conexao.php"; 
$disponiveis = 
$conn->query( 
"SELECT COUNT(*) total 
FROM quarto 
WHERE status='Disponível'" 
)->fetch_assoc()['total'];
 $ocupados = 
 $conn->query( 
    "SELECT COUNT(*) total 
    FROM quarto 
    WHERE status='Ocupado'" 
    )->fetch_assoc()['total']; 
    $reservas = 
    $conn->query( 
        "SELECT COUNT(*) total 
        FROM reserva 
        WHERE status='Reservada'" 
        )->fetch_assoc()['total'];
         ?> 
         <!DOCTYPE html> 
         <html>
          <head> <meta charset="UTF-8"> 
          <title>HotelSys</title> 
          </head>
           <body> 
           <h1>HotelSys</h1>
            <h2> Bem-vindo,
             <?php echo htmlspecialchars(
                 $_SESSION['usuario']
                  ); ?> 
                  </h2> 
                  <hr> <h3>Indicadores</h3>
                   <p> Quartos disponíveis:
                    <strong> 
                    <?php echo $disponiveis; ?> </strong>
                     </p>
                      <p> Quartos ocupados:
                       <strong> 
                       <?php echo $ocupados; ?>
                        </strong> 
                        </p> 
                        <p> Reservas:
                         <strong> 
                        <?php echo $reservas; ?> 
                        </strong>
                         </p>
                          <hr>
                           <h3>Menu</h3> 
                           <a href="hospedes.php">
                            Hóspedes </a>
                             <br>
                              <a href="quartos.php">
                               Quartos </a> 
                               <br> 
                               <a href="reservas.php">
                                Reservas </a> 
                                <br> 
                                <a href="checkin.php"> 
                                Check-in </a> 
                                <br>
                                 <a href="checkout.php"> 
                                 Check-out </a> 
                                 <br> 
                                 <a href="relatorio.php">
                                  Relatório </a> 
                                  <br>
                                  <br> 
                                  <a href="logout.php"> Sair </a> 
                                  </body> 
                                  </html> 