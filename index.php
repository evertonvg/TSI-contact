<?php 
require_once('assets/inc/conexao.php');
require_once('assets/inc/header.php');



if(!isset($_SESSION['login'])){
      echo '<section class="aviso">
        <p class="contact">Procurando alguma informação sobre horários do curso? use o TSI contact.</p>
        <div class="tela_login"><a href="login.php" data-janela="#janela1" rel="modal" id="login" class="tela_login_link">ACESSE AGORA</a></div>
      </section>';
      }
else{
  $sql = 'SELECT* from noticias order by data_hora desc limit 3';
  $noticias = mysqli_query($conexao,$sql);
  $nots = mysqli_fetch_all($noticias);
  

  if(mysqli_num_rows($noticias)=='0'){
    '<div class="noticias">
      <div class="tituloo col-lg-12"><h3>Olá '.$_SESSION['user'].', infelizmente não existem noticias disponiveis.</h3></div>
    </div>';
  }
  else{
      echo '<div class="noticias container">
      <div class="tituloo col-lg-12"><h3>Olá '.$_SESSION['user'].', confira algumas das últimas novidades do curso.</h3></div>

          <a href="noticias.php?id='.$nots['0']['0'].'" title="titulo 1" target="_blank">
          <div class="noticia1 col-lg-7" style="background-image:url('.$nots['0']['3'].');">
            
            <div class="titulorodape">'.$nots['0']['1'].'</div>
          </div></a>

          <a href="noticias.php?id='.$nots['1']['0'].'" title="titulo 2" target="_blank">
          <div class="noticia2 col-lg-4" style="background-image:url('.$nots['1']['3'].');">
           
            <div class="titulorodape">'.$nots['1']['1'].'</div>
          </div></a>

          <a href="noticias.php?id='.$nots['2']['0'].'" title="titulo 3" target="_blank">
          <div class="noticia3 col-lg-4" style="background-image:url('.$nots['2']['3'].');">
            
            <div class="titulorodape">'.$nots['2']['1'].'</div>
          </div></a>

       </div>
       <div class="divnoticias"><a href="maisnoticias.php" class="botaonoticias" title="Mais novidades">Mais novidades</a></div>';

  }  
}      

require_once('assets/inc/footer.php');
?>    