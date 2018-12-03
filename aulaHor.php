<?php
require_once('assets/inc/conexao.php');
require_once('assets/inc/header.php');
require_once('assets/func/funcoes.php');
?>
<div class="anuncioo">
	<h3>Disciplinas por sala</h3>
</div>
<form method="post" action="aulaHorarios.php">
	<div class="botao_direita">
		<?php
			selectambiente($conexao);
		?>	
						<select class="ppp" id="turno" name="turno">
							<option value="">Selecione o Turno</option>
							<option value="Manhã">Manhã</option>
							<option value="Tarde">Tarde</option>
							<option value="Noite">Noite</option>
						</select>
						<input type="submit" name="enviar" value="pesquisar" class="ppp">
	</div>
	<div class="tabelahorarios">
		<p class="tabela">Por favor selecione os dados e aperte "pesquisar...".</p>
	</div>
</form>


<?php
require_once('assets/inc/footer.php');
?>