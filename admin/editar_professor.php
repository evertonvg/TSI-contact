<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$nome = $_POST['nomeProfessor'];
	$siape = $_POST['siape'];
	$coordenador = '0';
	if($_POST['coordenador']=='1'){
		$coordenador = '1';
	}
	

	$sql = "UPDATE professores SET nome='".$nome."',siape='".$siape."',coordenador='".$coordenador."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Professor ".$nome." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Professor ".$nome." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Professores.php');
}
else{
	$id = $_GET['id'];
	$nome = $_GET['nome'];
	$sql = "SELECT* FROM professores WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_assoc($resultado);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Alunos.php');
	}
}
?>
<form action="editar_professor.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do professor <?php echo $nome;?></h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="nomeProfessor">Nome:</label><input type="text" id="nomeProfessor" name="nomeProfessor" value="<?php echo $result['nome'];?>">
	<label for="Siape">Siape:</label><input type="number" id="Siape" name="siape" value="<?php echo $result['siape'];?>">
	<label for="coordenador" class="custom-control-label">Coordenador?:</label><input type="checkbox" name="coordenador" id="coordenador" value="1" class="custom-control-input" <?php if($result['coordenador']==1){echo 'checked ';} ?> >
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>