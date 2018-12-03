<?php 
require "assets/inc/conexao.php"; 
?>
<form action="registrar.php" method="post" class="forme">
	<a href="#" id="fechar">Fechar</a>
	<h3>selecione seu tipo de usuario:</h3>
	<input type="button" name="categoria" value="professor" class="categoria1 categorias" id="prof"><br>
	<input type="button" name="categoria" value="aluno" class="categoria2 categorias" id="aluno"><br>
	<input type="button" name="categoria" value="monitor" class="categoria3 categorias" id="monitor"><br>
</form>