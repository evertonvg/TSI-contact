<?php 
require_once('assets/inc/conexao.php');
?>
<form action="logar.php" method="post" class="forme" name="form" > 
	<a href="#" id="fechar">Fechar</a>
	<h3>Login e Senha</h3>

	<div class="form-group">
		<label for="log">Usuario:<span>Usuario Inválido</span></label><input type="text" name="log" id="log" placeholder="Use seu apelido" class="login5"><br>
	</div>
	
	<div class="form-group">
		<label for="senha">Senha:<span>Senha inválida</span></label><input type="password" name="senha" id="senha" placeholder="senha de 8 digitos" minlength="8" maxlength="32" class="senha5">
	</div>
	
	<input type="submit" name="enviar" class="enviar">
</form> 