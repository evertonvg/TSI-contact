<?php
require_once("../assets/inc/conexao.php");
?>
<!doctype html>
<html lang="pt_br">
<head>
  <link href="https://fonts.googleapis.com/css?family=Anton|PT+Sans" rel="stylesheet">
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TSI contact</title>
  <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
  <meta property="og:title" content="" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="">
  <meta name="twitter:creator" content="@">
  <meta name="twitter:title" content ="">
  <meta name="twitter:description" content="">  
  <meta name="twitter:image" content="">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/scripts.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.mask.js"></script>
  <script type="text/javascript" src="../assets/js/validacao.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  
  <div class="swapper">
    <div class="cabeca_admin">
        <div class="logo">
          <a href="admin.php" class="espaco"><img src="../assets/img/admin.png" alt="logo  do tsi" width="160px"></a>
        </div>
        <nav class="naveg_admin">
         <ul>
          <?php 
            echo '<li><a href="../logout.php">Logout</a></li>
                  <li><a href="../Perfil.php?id='.$_SESSION['id'].'">'.$_SESSION['user'].'</a></li>
                  <li><a href="../index.php">Home</a></li>';
          ?>  
         </ul>
       </nav>
    </div> 

    <div class="traseira" style="background-image: url('../assets/img/bege.png');">

      <div class="mensagem_php">
        
        <?php 
          if(isset($_SESSION['mensagem'])){
            echo '<p class="'.$_SESSION['estilo'].' message">'.$_SESSION['mensagem'].'</p>';
            unset($_SESSION['mensagem']);
            unset($_SESSION['estilo']);
          }
        ?>
      </div> 
