<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['sim2'])){
	$id=$_POST['idNoticia'];

	$sql = "SELECT foto FROM  noticias where id=".$id;
	$selecao = mysqli_query($conexao,$sql);
	$foto = mysqli_fetch_array($selecao);
	
	$sql = "DELETE FROM  noticias where id=".$id;
	$exclusao = mysqli_query($conexao,$sql);
	if($exclusao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			unlink('../'.$foto['foto']);
			$_SESSION['mensagem']='Noticia removida com sucesso!';
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Noticia não pode ser deletada!";
			$_SESSION['estilo'] = 'alert-warning';
		}	
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a exclusão da noticia. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Publicacoes.php');
}
else{
	$id=$_GET['id'];
	$nome=$_GET['nome'];	
	
}
?>
<form method="post" action="excluir_noticia.php">
	<input type="hidden" name="idNoticia" value="<?php echo $id; ?>">
	<a href="#" id="fechar">Fechar</a>
	<h3>Você realmente deseja excluir o a noticia <?php echo $nome;?>?</h3>
	<input type="submit" name="sim2" value="SIM" class="sim2">
	<input type="submit" name="nao2" value="NAO" class="nao2" id="nao2">
</form>