<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarAmbiente'])){
$nome = $_POST['NomeAmbiente'];
$referencia = $_POST['referencia'];
	
$sql = "INSERT INTO ambientes VALUES(default,'".$nome."','".$referencia."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Ambiente ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Ambiente ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Ambientes.php');
}
?>
<form method="post" action="AdicionarnovoAmbiente.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Novo Ambiente</h3>
	<label for="NomeAmbiente">Numero do ambiente:</label><input type="text" name="NomeAmbiente" id="NomeAmbiente"><br>
	<label for="referencia">Referência:</label><input type="text" name="referencia" id="referencia"><br>
	
	<input type="submit" name="AdicionarAmbiente" class="enviar">
</form>