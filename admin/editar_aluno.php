<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$nome = $_POST['nomeAluno'];
	$matricula = $_POST['matriculaAluno'];
	$estagiario = '0';
	if($_POST['Estagiario']=='1'){
		$estagiario = '1';
	}
	

	//$sqlEstagiario = "SELECT* FROM usuarios WHERE tipo_usuario='2' AND info=".$id;
	//$selecao =mysqli_query($conexao,$sqlEstagiario);
	
	
	//if($selecao){	
	//	if(mysqli_num_rows($selecao)>='1'){	
	//		$linha=mysqli_fetch_array($selecao,MYSQLI_ASSOC);
	//		if(($linha['admin']=='1')AND($estagiario == '0')){
	//			$sqlAdmin = "UPDATE usuarios set admin='0' WHERE id=".$linha['id'];	 
	//		}
	//		else{
	//			if(($linha['admin']=='0')AND($estagiario =='1')){
	//				$sqlAdmin = "UPDATE usuarios set admin='1' WHERE info=".$linha['id'];		
	//			}	
	//		}
	//		$result = mysqli_query($conexao,$sqlAdmin); 
	//	}	
	//}
	//echo $estagiario.' <br>';
	//echo mysqli_num_rows($selecao).'<br>';
	//print_r($linha).' <br>';
	//echo $sqlEstagiario.' <br>';
	//echo $sqlAdmin .' <br>';
	
	//die();
	

	$sql = "UPDATE alunos SET nome='".$nome."',matricula='".$matricula."',estagiario='".$estagiario."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Aluno ".$nome." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Aluno ".$nome." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Alunos.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM alunos WHERE id=".$id;
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
<form action="editar_aluno.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do aluno</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="nomeAluno">Nome:</label><input type="text" id="nomeAluno" name="nomeAluno" value="<?php echo $result['nome'];?>">
	<label for="matriculaAluno">Matricula:</label><input type="number" id="matriculaAluno" name="matriculaAluno" value="<?php echo $result['matricula'];?>">
	<label for="Estagiario" class="custom-control-label">Estagiario?:</label><input type="checkbox" name="Estagiario" id="Estagiario" value="1" class="custom-control-input" <?php if($result['estagiario']==1){echo 'checked ';} ?> >
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>