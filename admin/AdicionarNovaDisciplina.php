<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarDisciplina'])){
$nome = $_POST['NomeDisciplina'];
$semestre = $_POST['semestre'];
	
$sql = "INSERT INTO disciplinas VALUES(default,'".$nome."','".$semestre."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Disciplina ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Disciplina ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Disciplinas.php');
}
?>
<form method="post" action="AdicionarNovaDisciplina.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Nova Disciplina</h3>
	<label for="NomeDisciplina">Nome da disciplina:</label><input type="text" name="NomeDisciplina" id="NomeDisciplina"><br>
	<label for="semestre">semestre:</label><br>
	<?php
	$sql = 'SELECT* FROM semestres';
	$resultado = mysqli_query($conexao,$sql);
	$result = mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	if($result){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			echo '<select class="selectform" name="semestre" id="semestre">';
				foreach($result as $option){
					echo '<option value="'.$option['id'].'">'.$option['descricao'].'</option>';
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
	<input type="submit" name="AdicionarDisciplina" class="enviar">
</form>