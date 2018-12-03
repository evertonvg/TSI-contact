<?php 
require_once('assets/inc/conexao.php');
require_once('assets/inc/header.php');
if(isset($_POST['categoria'])){
	$categoria=$_POST['categoria'];
}else{
	$categoria=$_GET['categoria'];
}

if(isset($_POST['registro'])){
	$registro=$_POST['registro']; 
}else{
	$registro=$_GET['registro']; 

}

//$erro_apelido = isset($_GET['erro_usuario']) ? $_GET['erro_usuario'] : 0;
//$erro_email   = isset($_GET['erro_email'])   ? $_GET['erro_email'] : 0;

if($categoria=='professor'){
	$sql = "SELECT* FROM professores WHERE siape = '$registro'";
	}
else{
	if($categoria=='aluno'){
		$sql = "SELECT* FROM alunos WHERE matricula = '$registro'";
		}
	else{
		$sql = "SELECT* FROM alunos WHERE matricula='$registro' and id IN(SELECT id_aluno from monitores)";
		}
	}
$resultado=mysqli_query($conexao,$sql);

if($resultado){
	$linha=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
	if(mysqli_num_rows($resultado)>=1){	
		
	}
	else{
		$_SESSION['mensagem']="Não existem dados cadastrados!";
		$_SESSION['estilo'] = 'alert-warning';
		header('location:index.php');
	}
}
else{
	$_SESSION['mensagem']="Problema na requisição, contate o admin! Erro:".mysqli_error($conexao);
	$_SESSION['estilo'] = 'alert-danger';
	header('location:index.php');
}

?>

<div class="formulario_usuario">
	<h3>Insira seus dados para prosseguir com o cadastro:</h3>
	<form method="POST" action="formulario_usuario.php" enctype="multipart/form-data">
		<input type="hidden" name="categ" value="<?php echo $categoria;?>">
		<input type="hidden" name="id_user" value="<?php echo $linha['id'];?>">
		<label for="nome3">Nome:(apenas visualização)</label><input type="text" id="nome3" name="nome3" value="<?php echo $linha['nome'];?>" Readonly>
		<label for="registro3">Registro:(apenas visualização)</label><input type="number" name="registro3" id="registro3" Readonly value="<?php echo $registro;?>">
		<label for="apelido">Apelido:</label><input type="" name="apelido" id="apelido" required>
		<?php //if($erro_apelido) echo 'Apelido ja existe';?>
		<label for="email">Email:</label><input type="email" name="email" id="email" required>
		<?php // if($erro_email) echo 'Email ja existe';?>
		<label for="senha">Senha:</label><input type="password" name="senha" id="senha" required>
		<label for="senha1">Repita a senha:</label><input type="password" name="senha1" id="senha1" required>
		<label for="telefone">Telefone:</label><input type="number" name="telefone" id="telefone" placeholder="9 numeros">
		<label for="foto">Foto:(não obrigatório)
		</label><input type="file" name="foto" id="foto"><br>
		<input type="submit" name="enviar" class="cadastro_submit">
	</form>
</div>
<?php
require_once('assets/inc/footer.php');
?>