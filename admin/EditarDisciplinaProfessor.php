<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$nome = $_POST['profe'];
	

	$sql = "UPDATE disciplina_professor SET id_professor='".$nome."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Professor da disciplina modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Professor da disciplina não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:disciplinas_professores.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM disciplina_professor WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	$result = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

	$sql1 = "SELECT nome FROM disciplinas WHERE id=".$result['id_disciplina'];
	$resultado1 = mysqli_query($conexao,$sql1);
	$result1 = mysqli_fetch_array($resultado1,MYSQLI_ASSOC);
	
}
?>
<form action="EditarDisciplinaProfessor.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados da relação Disciplina / Professor</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="disciplina">Disciplina:(somente leitura)</label><input type="text" id="disciplina" name="disciplina" value="<?php echo $result1['nome'];?>" readonly>
	<label for="professor">Professor:</label>
	<select id="professor" class="selectform" name="profe">
		<?php 
		$sql3 = "SELECT* FROM professores";
		$solicitacao = mysqli_query($conexao,$sql3);
		$linhas = mysqli_fetch_all($solicitacao,MYSQLI_ASSOC);
		foreach ($linhas as $linha) {
			echo '<option value="';
			echo $linha['id'].'"';
			if($linha['id']==$result['id_professor']) {
				echo 'selected';
			}
			echo '>';
			echo $linha['nome'];
			echo '</option>';
		}
		?>
	</select>

	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>