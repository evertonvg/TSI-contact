<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$disciplina = $_POST['disciplina'];
	$professor = $_POST['profe'];
	

	$sql = "INSERT INTO disciplina_professor VALUES(default,'".$disciplina."','".$professor."')";
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Relação adicionada com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Relação não pode ser adicionada.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a operação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:disciplinas_professores.php');
}

?>
<form action="AdicionarNovaDisciplinaProfessor.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Insira os dados da relação Disciplina / Professor</h3>
	<label for="disciplina">Disciplina:</label>
	<select id="disciplina" class="selectform" name="disciplina">
		<?php 
		$sql4 = "SELECT* FROM disciplinas WHERE id NOT IN(SELECT id_disciplina FROM disciplina_professor)";
		$solicitacao = mysqli_query($conexao,$sql4);
		$linhass = mysqli_fetch_all($solicitacao,MYSQLI_ASSOC);
		if(mysqli_num_rows($solicitacao)=='0'){
			echo '<option value="">Não existem disciplinas para serem relacionadas</option>';
			die(); 
		}

		echo '<option value="">Selecione a disciplina</option>';
		foreach ($linhass as $linhaa) {
			echo '<option value="';
			echo $linhaa['id'].'">';
			echo $linhaa['nome'];
			echo '</option>';
		}
		?>
	</select>
	<label for="professor">Professor:</label>
	<select id="professor" class="selectform" name="profe">
		<?php 
		$sql3 = "SELECT* FROM professores";
		$solicitacao = mysqli_query($conexao,$sql3);
		$linhas = mysqli_fetch_all($solicitacao,MYSQLI_ASSOC);
		echo '<option value="">Selecione o professor</option>';
		foreach ($linhas as $linha) {
			echo '<option value="';
			echo $linha['id'].'">';
			echo $linha['nome'];
			echo '</option>';
		}
		?>
	</select>

	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>