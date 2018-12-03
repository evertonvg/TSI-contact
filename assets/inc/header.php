<!doctype html>
<html lang="pt_br">
<head>
  <link href="https://fonts.googleapis.com/css?family=Anton|PT+Sans" rel="stylesheet">
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TSI contact</title>
  <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
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
  <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="assets/js/scripts.js"></script>
  <script type="text/javascript" src="assets/js/jquery.mask.js"></script>
  <script type="text/javascript" src="assets/js/validacao.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head> 
<body >
  
  <div class="swapper">
    <div class="cabeca">
        <div class="logo">
          <a href="index.php" class="espaco"><img src="assets/img/pelotas_logo_superiorsistemasparainternet3.png" alt="logo  do tsi" width="160px"></a>
        </div>

        <div class="div_pesquisa">
          <form method="post" action="#" class="form-pesquisa">
            <form action=" " method="post" id="demo-2">             
              <div class="cont">
                <input type="search" id="busca" name="q"  class="pesquisa" placeholder="pesquisa">
                <!--<button type="submit" class="search"></button></input>-->
              </div> 
            </form> 
          </form> 
        </div>
        <div id="bt_menuu">
          <i class="fas fa-bars"></i>
        </div>
        <nav class="naveg"> 
         <ul class="menuu">
          <?php 
            echo '<li><a data-janela="#janela1" href="contato.php" rel="modal" id="contato">Contato</a></li>
                  <li><a href="quem_somos.php">sobre</a></li>';

            if(!isset($_SESSION['login'])){
              echo '<li><a data-janela="#janela1" href="registro.php" rel="modal" id="registro">Registrar</a></li>
                    <li><a data-janela="#janela1" href="login.php" rel="modal" id="login">Login</a></li>
                    ';
            }
            else{
              echo '<li><a href="logout.php">Logout</a></li>
                    <li><a href="#" class="seguranca1 deactive"><div class="seguranca2"><i class="fas fa-chevron-circle-down"></i></div>Consultar Horários</a>
                        <ul>
                          <li><a href="prof.php" title="professores">Professores</a></li>
                          <li><a href="monit.php" title="monitores">Monitores</a></li>
                          <li><a href="meuHor.php" title="meus horarios">Meus horários</a></li>
                          <li><a href="aulaHor.php" title="horários por sala">Horários por sala</a></li>
                        </ul>
                    </li>
                    <li><a href="Perfil.php?id='.$_SESSION['id'].'">'.$_SESSION['user'].'</a></li>';
            }
             if(isset($_SESSION['admin'])){
              echo '<li id="admin"><a href="admin/admin.php">Admin</a></li>';
             }
          ?>  
         </ul>
       </nav>
    </div> 

    <div class="traseira" style="background-image: url('assets/img/gestao-de-ti3.jpg');">
      <div class="mensagem_php">
        <?php 
          if(isset($_SESSION['mensagem'])){
            echo '<p class="'.$_SESSION['estilo'].' message">'.$_SESSION['mensagem'].'</p>';
            unset($_SESSION['mensagem']);
            unset($_SESSION['estilo']);
          }
        ?>
      </div>
