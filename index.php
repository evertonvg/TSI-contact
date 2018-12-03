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
  echo '
    <section class="aviso">
      <ul>
        <li>Horários dos professores</li>
        <li>Meus horarios de aula</</li>
        <li>Horarios por sala</li>
      </ul>
    </section>';
}      

require_once('assets/inc/footer.php');
?>    