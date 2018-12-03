<?php
require_once('assets/inc/conexao.php');
require_once('assets/inc/config_upload.php');

$nome_arquivo=$_FILES['foto']['name'];  
$tamanho_arquivo=$_FILES['foto']['size']; 
$arquivo_temporario=$_FILES['foto']['tmp_name']; 
$id = $_POST['id_user'];
$cat = $_POST['categ'];
$nome = $_POST['nome3'];
$registro = $_POST['registro3'];
$apelido = $_POST['apelido'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$telefone = $_POST['telefone'];


if($cat=='professor'){
	$pasta = 'Professores';
	$catInt = (int)1;
	mkdir('usuariosPastas/Professores/'.$registro);
	$sql = "SELECT* FROM professores where id='$id'";
	$query = mysqli_query($conexao,$sql);
	$linha = mysqli_fetch_assoc($query);
	if($linha['coordenador']==true){
		$admin = '1';
	} 
	else{
		$admin = '0';
	}
}
else{
	if($cat=='aluno'){
	$pasta = 'Alunos';
	$catInt = (int)2;
	mkdir('usuariosPastas/Alunos/'.$registro);
	$sql = "SELECT* FROM alunos where id='$id'";
	$query = mysqli_query($conexao,$sql);
	$linha = mysqli_fetch_assoc($query);
		if($linha['estagiario']==true){
			$admin = '1';
		}
		else{
			$admin = '0';
		}
	}
	else{
		$pasta = 'Monitores';
		$catInt = (int)3;
		mkdir('usuariosPastas/Monitores/'.$registro);
		$admin = '0';
	}
}
	
$caminho = 'usuariosPastas/'.$pasta.'/'.$registro.'/'.$nome_arquivo;
	if($tamanho_arquivo>0){
		if(($sobrescrever=="nao") && (file_exists("$caminho"))){
			$_SESSION['mensagem']="Arquivo já existe, escolha outro!";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
		}
		if(($limitar_tamanho=="sim") && ($tamanho_arquivo > $tamanho_bytes))  {
			$_SESSION['mensagem']="Arquivo deve ter no maximo ".$tamanho_bytes." bytes!";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
		}
		$ext = strrchr($nome_arquivo,'.');
		if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas)){
			$_SESSION['mensagem']="Extensão de arquivo inválida para upload! Escolha outro arquivo";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
		}
		$tamanhos = getimagesize($caminho);
		// echo $tamanhos[0];
		// echo $tamanhos[1];
		// die();

		//há um erro aqui com arquivos grandes
		if(($tamanhos[0] > $max_largura)||($tamanhos[1] > $max_altura)){
			$_SESSION['mensagem']="Dimensão da imagem não deve ultrapassar ".$tamanhos[1]."x".$tamanhos[1];
			$_SESSION['estilo'] = 'alert-warning';
			header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
		}
		$sqlVerficicaNome = "SELECT* FROM usuarios WHERE apelido =".$apelido;
		$verificaNome = mysqli_query($conexao,$sqlVerficicaNome);
		if($verificaNome){
			if(mysqli_num_rows($verificaNome)>='1'){
				$_SESSION['mensagem']="Apelido já está em uso! Selecione outro.";
				$_SESSION['estilo'] = 'alert-warning';
				header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
				}
		}
		$sqlVerficicaEmail = "SELECT* FROM usuarios WHERE email =".$email;
		$verificaEmail = mysqli_query($conexao,$sqlVerficicaEmail);
		if($verificaEmail){
			if(mysqli_num_rows($verificaEmail)>='1'){
				$_SESSION['mensagem']="Email já está em uso! Selecione outro.";
				$_SESSION['estilo'] = 'alert-warning';
				header('location:completa_cadastro.php?categoria='.$cat.'&registro='.$registro);
				}
		}

		if($cat=='professor'){
			move_uploaded_file($arquivo_temporario,"usuariosPastas/Professores/$registro/$nome_arquivo");
		}
		else{
			if($cat=='aluno'){
				move_uploaded_file($arquivo_temporario,"usuariosPastas/Alunos/$registro/$nome_arquivo");
			}
			else{
				move_uploaded_file($arquivo_temporario,"usuariosPastas/Monitores/$registro/$nome_arquivo");
			}

		}
		
	}
	else{
		$caminho='usuariosPastas/'.$pasta.'/'.$registro;
	}
	$sql2="INSERT INTO usuarios (tipo_usuario,info,apelido,email,senha,admin,foto,wpp_celular)VALUES('".$catInt."','".$id."','".$apelido."','".$email."','".$senha."','".$admin."','".$caminho."','".$telefone."')";

	$insercao = mysqli_query($conexao,$sql2);
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Usuario ".$apelido." adicionado com sucesso! Por favor realize o login para continuar.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Usuario ".$apelido." não pode ser adicionado. Contate o administrador do sistema";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:index.php');
?>