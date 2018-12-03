<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$descricao = $_POST['nomeSemestre'];
		

	$sql = "UPDATE semestres SET descricao='".$descricao."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Semestre ".$nome." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Semestre ".$nome." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Semestres.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM semestres WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Semestres.php');
	}
}
?>
<form action="editar_semestre.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do semestre</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="nomeSemestre">Descrição do semestre:</label><input type="text" id="nomeSemestre" name="nomeSemestre" value="<?php echo $result['descricao'];?>">
	
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>