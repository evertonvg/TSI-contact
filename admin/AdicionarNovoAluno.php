<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarAluno'])){
$nome = $_POST['NomeAluno'];
$matricula = $_POST['NumeroMatricula'];
	if($_POST['estagiario']=='true'){
		$estagiario = '1';
	}
	else{
		$estagiario = '0';
	}
$sql = "INSERT INTO alunos VALUES(default,'".$nome."','".$matricula."','".$estagiario."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Aluno ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Aluno ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Alunos.php');
}
?>
<form method="post" action="AdicionarNovoAluno.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Novo Aluno</h3>
	<label for="NomeAluno">Nome do Aluno:</label><input type="text" name="NomeAluno" id="NomeAluno"><br>
	<label for="NumeroMatricula">Nº de matricula:</label><input type="number" name="NumeroMatricula" id="NumeroMatricula"><br>
	<label for="estagiario" class="custom-control-label">estagiario?:</label><input type="checkbox" name="estagiario" id="estagiario" value="true" class="">
	<input type="submit" name="AdicionarAluno" class="enviar">
</form>