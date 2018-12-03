<?php 
require_once('assets/inc/conexao.php');

$Login=$_POST['log'];
$senha=$_POST['senha'];
$senha=md5($senha);

$sql="SELECT* FROM usuarios WHERE apelido='$Login' AND senha='$senha'"; //não consegui usar o email
$result=mysqli_query($conexao,$sql);


if($result){
	$resultado=mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)>='1'){
		$_SESSION['login']=true;
		$_SESSION['id']=$resultado['id'];
		$_SESSION['user']=$resultado['apelido'];
		$_SESSION['email']=$resultado['email'];
		$_SESSION['caminho_arquivo']=$resultado['foto'];
		$arquivoo=explode('/', $resultado['foto']);
		$_SESSION['arquivo']=$arquivoo['3'];

		


		if($resultado['tipo_usuario']=='1'){
			$_SESSION['tipo_usuario']='professor';

			$sql1 = 'SELECT* FROM professores WHERE id='.$resultado['info'];
			$consulta1 = mysqli_query($conexao,$sql1);
			$itens = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
			$_SESSION['registro']=$itens['siape'];
		}
		else{
			
			if($resultado['tipo_usuario']=='2'){
				$_SESSION['tipo_usuario']='aluno';

				$sql1 = 'SELECT* FROM alunos WHERE id='.$resultado['info'];
				$consulta1 = mysqli_query($conexao,$sql1);
				$itens = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
				$_SESSION['registro']=$itens['matricula'];
			}
			else{
				if($resultado['tipo_usuario']=='3'){
					$_SESSION['tipo_usuario']='monitor';

					$sql1 = 'SELECT* FROM monitores WHERE id='.$resultado['info'];
					$consulta1 = mysqli_query($conexao,$sql1);
					$itens2 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);

					$sql2 = 'SELECT* FROM alunos WHERE id='.$itens2['id_aluno'];
					$consulta2 = mysqli_query($conexao,$sql2);
					$itens = mysqli_fetch_array($consulta2,MYSQLI_ASSOC);
					$_SESSION['registro']=$itens['matricula'];
				}
			}
		}

		if($resultado['admin']==true){
			$_SESSION['admin']=true;
		}
		$_SESSION['mensagem']="Bem vindo ".$_SESSION['user']. "!";
		$_SESSION['estilo'] = 'alert-success';
	}
	else{
		$_SESSION['mensagem']='Usuario ou senha invalidos';
		$_SESSION['estilo'] = 'alert-warning';
	}
}
else{
	$_SESSION['mensagem']='Impossivel conectar - contate o administrador do sistema! Erro: '.mysqli_error();
	$_SESSION['estilo'] = 'alert-danger';
}

header('location:index.php');
?>