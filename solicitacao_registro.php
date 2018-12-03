<?php 
require_once('assets/inc/conexao.php');
$registro=$_POST['registro'];
$categoria=$_POST['categoria'];
 

if($categoria=='professor'){
	$sql = "SELECT* FROM professores WHERE siape = '$registro' and id NOT IN(SELECT info from usuarios WHERE tipo_usuario='1')";
	$resultado=mysqli_query($conexao,$sql);
	}
else{
	if($categoria=='aluno'){
		$sql = "SELECT* FROM alunos WHERE matricula = '$registro'  and id NOT IN(SELECT info from usuarios WHERE tipo_usuario='2')";
		$resultado=mysqli_query($conexao,$sql);
		}
	else{
		$sql = "SELECT* FROM alunos WHERE matricula='$registro' and id IN(SELECT id_aluno from monitores) and id NOT IN(SELECT info from usuarios WHERE tipo_usuario='3')";
		$resultado=mysqli_query($conexao,$sql);
		}
	}
	$linha=mysqli_fetch_assoc($resultado);
	echo json_encode($linha);


?>