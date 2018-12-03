<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['sim2'])){
	$id=$_POST['idHorario'];
	
	$sql = "DELETE FROM horarios WHERE id=".$id;
	$exclusao = mysqli_query($conexao,$sql);
	if($exclusao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']='Horário removido com sucesso!';
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Horário não pode ser deletado!";
			$_SESSION['estilo'] = 'alert-warning';
		}	
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a exclusão do Horário. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Horarios.php');
}
else{
	$id=$_GET['id'];
	$horario=$_GET['horario'];	
	$dia=$_GET['dia'];	
}
?>
<form method="post" action="excluir_horario.php">
	<input type="hidden" name="idHorario" value="<?php echo $id; ?>">
	<a href="#" id="fechar">Fechar</a>
	<h3>Você realmente deseja excluir o horário das <?php echo $horario;?> de <?php echo $dia;?>?</h3>
	<input type="submit" name="sim2" value="SIM" class="sim2">
	<input type="submit" name="nao2" value="NAO" class="nao2" id="nao2">
</form>