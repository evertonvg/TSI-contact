<?php
require_once('assets/inc/conexao.php');
require_once('assets/inc/config_upload.php');
$id = $_SESSION['id'];
$apelido = $_POST['apelido'];
$email = $_POST['email'];
$wpp = $_POST['wpp'];
$registro = $_SESSION['registro'];


$nome_arquivo=$_FILES['foto']['name'];  
$tamanho_arquivo=$_FILES['foto']['size']; 
$arquivo_temporario=$_FILES['foto']['tmp_name'];

if($tamanho_arquivo>0){

	if($_SESSION['tipo_usuario']=='professor'){
		$caminho = 'usuariosPastas/Professores/'.$registro.'/'.$nome_arquivo;
	}
	else{
		if($_SESSION['tipo_usuario']=='aluno'){
			$caminho = 'usuariosPastas/Alunos/'.$registro.'/'.$nome_arquivo;
		}
		else{
			$caminho = 'usuariosPastas/Monitores/'.$registro.'/'.$nome_arquivo;
		}
		
	}
	// $image_info = getimagesize($caminho); 
	// print_r($image_info);
	// die();

	if(($sobrescrever=="nao") && (file_exists("$caminho"))){
		$_SESSION['mensagem']="Arquivo já existe, escolha outro!";
		$_SESSION['estilo'] = 'alert-warning';
		header('location:perfil.php?id='.$id);
		die();

	}
	if(($limitar_tamanho=="sim") && ($tamanho_arquivo > $tamanho_bytes))  {
		$_SESSION['mensagem']="Arquivo deve ter no maximo ".$tamanho_bytes." bytes!";
		$_SESSION['estilo'] = 'alert-warning';
		header('location:perfil.php?id='.$id);
		die();
	}
	$ext = strrchr($nome_arquivo,'.');
	if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas)){
		$_SESSION['mensagem']="Extensão de arquivo inválida para upload! Escolha outro arquivo";
		$_SESSION['estilo'] = 'alert-warning';
		header('location:perfil.php?id='.$id);
		die();
	}

	$tamanhos = getimagesize($caminho);
	// echo $tamanhos[0];
	// echo $tamanhos[1];
	// die();

	//há um erro aqui com arquivos grandes
	if(($tamanhos[0] > $max_largura)||($tamanhos[1] > $max_altura)){
		$_SESSION['mensagem']="Dimensão da imagem não deve ultrapassar ".$tamanhos[1]."x".$tamanhos[1];
		$_SESSION['estilo'] = 'alert-warning';
		header('location:perfil.php?id='.$id);
		die();
	}
	if($_SESSION['tipo_usuario']=='professor'){
		move_uploaded_file($arquivo_temporario,"usuariosPastas/Professores/$registro/$nome_arquivo");
	}
	else{
		if($_SESSION['tipo_usuario']=='aluno'){
			move_uploaded_file($arquivo_temporario,"usuariosPastas/Alunos/$registro/$nome_arquivo");
		}
		else{
			move_uploaded_file($arquivo_temporario,"usuariosPastas/Monitores/$registro/$nome_arquivo");
		}	
	}
	unlink($_SESSION['caminho_arquivo']);
	$_SESSION['caminho_arquivo']=$caminho;
		

	$sql = "UPDATE usuarios set apelido='".$apelido."',email='".$email."',foto='".$caminho."',wpp_celular='".$wpp."' WHERE id=".$id;
	}else{
		$sql = "UPDATE usuarios set apelido='".$apelido."',email='".$email."',wpp_celular='".$wpp."' WHERE id=".$id;
	}

$modificacao = mysqli_query($conexao,$sql);
if($modificacao){
	$linhas_afetadas = mysqli_affected_rows($conexao);
	if($linhas_afetadas>='1'){

			$_SESSION['mensagem']="Usuario ".$apelido." modificado com sucesso!";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Usuario ".$apelido." não foi modificado";
			$_SESSION['estilo'] = 'alert-warning';
		}
}
else{
	$erro = mysqli_error($conexao);
	$_SESSION['mensagem']="Não foi possivel realizar a modificação! Por favor volte mais tarde. Erro: ".$erro;
	$_SESSION['estilo'] = 'alert-danger';
}


header('location:perfil.php?id='.$id);











?>