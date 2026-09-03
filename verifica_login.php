<?php
 session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location: index.php"); 
     exit; 
     } 
     /* Tempo máximo: 30 minutos */ 
      $tempoMaximo = 1800; 
       if(    
         isset($_SESSION['ultimo_acesso'])  
            &&    
             time() -   
               $_SESSION['ultimo_acesso']  
                  > $tempoMaximo 
                  ){     
                    session_destroy();   
                    header("Location: index.php"); 
                         exit; 
                          } 
                           $_SESSION['ultimo_acesso'] = 
                           time();  
                           ?> 