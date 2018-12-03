<?php 
require_once('assets/inc/conexao.php');
?>
<form action="completa_cadastro.php" method="post" class="forme">
	<input type="hidden" name="categoria" id="categoria" value="">
	<a href="#" id="registro" class="voltar">Voltar</a>
	<a href="#" id="fechar">Fechar</a>
	<div id="tituloShow"></div>
	<input type="number" name="registro" id="registro2"><br>
	<input type="submit" name="enviar" value="verificar" class="agora verificar" id="verificar">



	<h3 class="oi">Esse é você?:</h3>
	<input type="text" name="nomePessoa" Readonly id="nomePessoa" value="" placeholder="Esse é seu nome?" class="oi">
	<div class="opcao oi">
		<div class="left"><input type="submit" name="SIM" class="sim" id="sim" value="SIM"></div>
		<div class="right"><input type="buttom" name="NAO" class="nao" id="nao" value="NÃO"></div>
	</div>
		
	<div id="campohidden">
		
	</div>				
</form>
