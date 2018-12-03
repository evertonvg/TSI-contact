<?php
require_once('assets/inc/conexao.php');
if(isset($_POST['enviar'])){
	$id=$_POST['id'];
	$password1=$_POST['password1'];
	$password1=md5($password1);
	$password3=$_POST['password3'];
	$password3=md5($password3);


	$sql = 'SELECT senha FROM usuarios WHERE id='.$id;
	$result = mysqli_query($conexao,$sql);
	if($result){
	$linha = mysqli_fetch_array($result,MYSQLI_ASSOC); 	
		if(mysqli_num_rows($result)>='1'){
			if($linha['senha']==$password1){
				$sql = 'UPDATE usuarios set senha="'.$password3.'" WHERE id='.$id;
				$result1 = mysqli_query($conexao,$sql);
				if($result1){
					if(mysqli_affected_rows($conexao)>='1'){
						$_SESSION['mensagem']='Senha modificada com sucesso!';
						$_SESSION['estilo'] = 'alert-success';
					}
					else{
						$_SESSION['mensagem']='Senha não foi modificada - senhas iguais!';
						$_SESSION['estilo'] = 'alert-warning';
					}
				}	
			}
			else{
				$_SESSION['mensagem']='Combinação de senhas imcompativel - tente novamente';
				$_SESSION['estilo'] = 'alert-danger';
			}	
		}	
	}
	else{
		$_SESSION['mensagem']='Impossivel conectar - contate o administrador do sistema! Erro: '.mysqli_error();
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:Perfil.php?id='.$id);
}
?>


<form method="post" action="modificar_senha.php"> 
	<a href="#" id="fechar" class="forme">Fechar</a>
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<h3>Modificar senha:</h3>
	<label for="senha1">Digite sua senha atual:</label><input type="password" name="password1" id="senha1">
	<label for="senha2">Repita sua senha atual:</label><input type="password" name="password2" id="senha2">
	<label for="senha3">Digite sua nova senha:</label><input type="password" name="password3" id="senha3">
	<input type="submit" name="enviar" class="enviar">
</form>