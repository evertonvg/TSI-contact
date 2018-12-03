<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarAluno'])){
$nome = $_POST['nomeProfessor'];
$siape= $_POST['siape'];
	if($_POST['coordenador']=='true'){
		$coordenador = '1';
	}
	else{
		$coordenador = '0';
	}

$sql = "INSERT INTO professores VALUES(default,'".$nome."','".$siape."','".$coordenador."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Professor ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Professor ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Professores.php');
}
?>
<form method="post" action="AdicionarProfessor.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Novo Professor</h3>
	<label for="nomeProfessor">nome:</label><input type="text" name="nomeProfessor" id="nomeProfessor"><br>
	<label for="siape">siape:</label><input type="number" name="siape" id="siape" placeholder="siape - 9 digitos"><br>
	<label for="coordenador" class="custom-control-label">Coordenador?:</label><input type="checkbox" name="coordenador" id="coordenador" value="true" class="custom-control-input"><br>
	<input type="submit" name="AdicionarAluno" class="enviar">
</form>