<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$nome = $_POST['nomeDisciplina'];
	$idsemestre = $_POST['semestre'];
	


	$sql = "UPDATE disciplinas SET nome='".$nome."',id_semestre='".$idsemestre."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Disciplina ".$nome." modificada com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Disciplina ".$nome." não foi modificada - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Disciplinas.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM disciplinas WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_assoc($resultado);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Disciplinas.php');
	}
}
?>
<form action="editar_disciplina.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do aluno</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="nomeDisciplina">Nome da Disciplina:</label><input type="text" id="nomeDisciplina" name="nomeDisciplina" value="<?php echo $result['nome'];?>">
	<label for="semestre">semestre:</label><br>

	<?php
	$sql = 'SELECT* FROM semestres';
	$resultados = mysqli_query($conexao,$sql);
	$results = mysqli_fetch_all($resultados,MYSQLI_ASSOC);
	if($results){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			echo '<select class="selectform" name="semestre" id="semestre">';
				foreach($results as $option){
					echo '<option value="'.$option['id'].'"';
					if($result['id_semestre']==$option['id']){
						echo 'selected';
					}
					echo '>'.$option['descricao'].'</option>';
				}
			echo '</select>';
		}
		else{
			$_SESSION['mensagem']="Não existem semestres ofertados.";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:Disciplinas.php');
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Disciplinas.php');
	}
	?>
	
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>