<?php
require_once("assets/func/SOs_naveg.php"); 
$SO =  Obter_SO();
$BR =  Obter_Browser();
?>
</div>
      <footer class="foot">
        <p class="copy">Copyright &copy 2018 - Everton Vargas Guetierres - Todos os direitos reservados</p>
        <p class="contato">Endereço : Praça 20 de Setembro, 455 - Pelotas/RS</p>
        <p class="contato">contato: <img src="assets/img/whatsapp-logo-1.png" width="20px"> : 999999999 - 
          <a href="#"><img src="assets/img/facebook-icone-icon-3.png" width="20px"></a> - <img src="assets/img/icone-circular-email.png" width="20px"> : evertonIEE@yahoo.com.br</p>
        <p class="copy">Você está usando um S.O. <?php echo $SO;?> em um browser <?php echo $BR;?></p>
      </footer>     
  </div>


<div class="window" id="janela1">
    <img src="assets/img/loader.gif" class="carrega">
</div>
<div id="mascara"></div>

</body>
</html>