<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['sim2'])){
	$id=$_POST['idDisciplina'];
	$nome=$_POST['nomeDisciplina'];
	$sql = "DELETE FROM disciplinas WHERE id=".$id;
	$exclusao = mysqli_query($conexao,$sql);
	if($exclusao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Disciplina ".$nome." removida com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Disciplina ".$nome." não pode ser deletada.";
			$_SESSION['estilo'] = 'alert-warning';
		}	
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a exclusão do Aluno. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Disciplinas.php');
}
else{
	$id=$_GET['id'];
	$nome=$_GET['nome'];	
}
?>
<form method="post" action="excluir_disciplina.php">
	<input type="hidden" name="nomeDisciplina" value="<?php echo $nome; ?>">
	<input type="hidden" name="idDisciplina" value="<?php echo $id; ?>">
	<a href="#" id="fechar">Fechar</a>
	<h3>Você realmente deseja excluir a disciplina <?php echo $nome;?></h3>
	<input type="submit" name="sim2" value="SIM" class="sim2">
	<input type="submit" name="nao2" value="NAO" class="nao2" id="nao2">
</form>