<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$nome = $_POST['nomeAmbiente'];
	$referencia = $_POST['referencia'];

	$sql = "UPDATE ambientes SET nummero='".$nome."',referencia='".$referencia."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Ambiente ".$nome." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Ambiente ".$nome." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Ambientes.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM ambientes WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_assoc($resultado);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Ambientes.php');
	}
}
?>
<form action="editar_ambiente.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do ambiente</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="nomeAmbiente">Numero do ambiente:</label><input type="text" id="nomeAmbiente" name="nomeAmbiente" value="<?php echo $result['nummero'];?>">
	<label for="referencia">Referencia:</label><input type="text" id="referencia" name="referencia" value="<?php echo $result['referencia'];?>">
	
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>