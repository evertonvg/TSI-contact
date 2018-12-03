<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$id_aluno = $_POST['id_aluno'];
	$id_disciplina = $_POST['id_disciplina'];
	$id_orientador = $_POST['id_orientador'];

	

	$sql = "UPDATE monitores SET id_aluno='$id_aluno',id_disciplina='$id_disciplina',id_orientador='$id_orientador' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Monitor ".$id_aluno." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Monitor ".$id_aluno." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Monitores.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM monitores WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_assoc($resultado);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Monitores.php');
	}
}
?>
<form action="EditarMonitor.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do Monitor</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="id_aluno">id_aluno:</label><input type="number" id="id_aluno" name="id_aluno" value="<?php echo $result['id_aluno'];?>">
	<label for="id_disciplina">id_disciplina:</label><input type="number" id="id_disciplina" name="id_disciplina" value="<?php echo $result['id_disciplina'];?>">
	<label for="id_orientador">id_orientador:</label><input type="number" id="id_orientador" name="id_orientador" value="<?php echo $result['id_orientador'];?>">
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>