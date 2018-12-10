<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$apelido = $_POST['apelido'];
	$email = $_POST['email'];
	$senhapura = $_POST['senha'];
	$senha = md5($senhapura);
	//após aqui mandaria um email//
	
	$telefone = $_POST['telefone'];
	if($_POST['improprio']=='1'){
		$foto = '';
	}
	else{
		$foto = $_POST['caminhoFoto'];
	}
	if( $_POST['Admin']=='1'){
		$admin ='1';
	}
	else{
		$admin ='0';
	}
	
	

	$sql = "UPDATE usuarios SET apelido='".$apelido."',email='".$email."',senha='".$senha."',foto='".$foto."',wpp_celular='".$telefone."',admin='".$admin."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Usuario ".$nome." modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Usuario ".$nome." não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:usuarios.php');
}
else{
	$id = $_GET['id'];
	$apelido = $_GET['nome'];
	$sql = "SELECT* FROM usuarios WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_assoc($resultado);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Usuarios.php');
	}
}
?>
<form action="Editarusuario.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do usuario <?php echo $apelido;?></h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="Usuario">Apelido:</label><input type="text" id="Usuario" name="apelido" value="<?php echo $result['apelido'];?>">
	<label for="Email">Email:</label><input type="email" id="Email" name="email" value="<?php echo $result['email'];?>">
	<label for="senha">Senha:</label><input type="password" name="senha" id="senha" value="<?php echo $result['senha'];?>">
	<label for="telefone">Telefone:</label><input type="text" name="telefone" value="<?php echo $result['wpp_celular'];?>">
	<!--<label for="senha">Senha:</label><input type="text" name="senha" value="<?php echo $result['senha'];?>">-->
	<label for="caminhoFoto">Caminho da foto:</label><input type="text" name="caminhoFoto" readonly id="caminhoFoto"value="<?php echo $result['foto']; ?>">	
	<label for="improprio">Foto imprópria?:</label><input type="checkbox" name="improprio" id="improprio" value="1" class="custom-control-input">
	<label for="Admin" class="custom-control-label">Admin?:</label><input type="checkbox" name="Admin" id="Admin" value="1" class="custom-control-input" <?php if($result['admin']==1){echo 'checked ';} ?> >

	<input type="submit" name="Enviar" value="Modificar" class="enviar Editarusuario"">
</form>

<script type="text/javascript">
	$('input[name="telefone"]').mask('(00)00000-0000');
</script>