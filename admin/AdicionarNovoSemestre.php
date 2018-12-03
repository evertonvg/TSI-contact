<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarNovoSemestre'])){
$nome = $_POST['NomeSemestre'];

$sql = "INSERT INTO semestres VALUES(default,'".$nome."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Semestre ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Semestre ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Semestres.php');
}
?>
<form method="post" action="AdicionarNovoSemestre.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Novo Semestre</h3>
	<label for="NomeSemestre">Descrição do semestre:</label><input type="text" name="NomeSemestre" id="NomeSemestre"><br>
	<input type="submit" name="AdicionarNovoSemestre" class="enviar">
</form>