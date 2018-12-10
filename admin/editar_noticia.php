<?php
require_once("../assets/inc/conexao.php");
require_once("../assets/inc/config_upload.php");
require_once("assets/inc/header.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Editar'])){
	$id = $_POST['id'];
	$nome_arquivo=$_FILES['mudafoto']['name'];  
	$tamanho_arquivo=$_FILES['mudafoto']['size']; 
	$arquivo_temporario=$_FILES['mudafoto']['tmp_name']; 

	$caminho = '../usuariosPastas/Noticias/'.$nome_arquivo;

	$titulo = $_POST['mudatitulo'];
	$conteudo = $_POST['conteudo'];


	if($tamanho_arquivo>0){
		if(($sobrescrever=="nao") && (file_exists("$caminho"))){
			$_SESSION['mensagem']="Arquivo já existe, escolha outro!";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:editar_noticia.php?id='.$id);
		}
		if(($limitar_tamanho=="sim") && ($tamanho_arquivo > $tamanho_bytes))  {
			$_SESSION['mensagem']="Arquivo deve ter no maximo ".$tamanho_bytes." bytes!";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:editar_noticia.php?id='.$id);
		}
		$ext = strrchr($nome_arquivo,'.');
		if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas)){
			$_SESSION['mensagem']="Extensão de arquivo inválida para upload! Escolha outro arquivo";
			$_SESSION['estilo'] = 'alert-warning';
			header('location:editar_noticia.php?id='.$id);
		}
	}

	$caminho = 'usuariosPastas/Noticias/'.$nome_arquivo;

	$sql = "UPDATE noticias SET titulo='".$titulo."',conteudo='".$conteudo."',foto='".$caminho."' WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if(!$resultado){
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel fazer a requisição! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		
	}
	else{
		move_uploaded_file($arquivo_temporario,'../'.$caminho);
		$_SESSION['mensagem']="Públicação editada com sucesso!";
		$_SESSION['estilo'] = 'alert-success';
		}
	
	header('location:Publicacoes.php');

}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROm noticias where id=".$id;
	$resultado = mysqli_query($conexao,$sql);

	if(!$resultado){
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel fazer a requisição! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Publicacoes.php');
	}
	else{
		$result=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
		}
	}
?>
<div class="principal">
	<form method="post" action="editar_noticia.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="cabecalhonoticia" style="background-image:url('../<?php echo $result['foto']; ?>');">
		</div>
		<div class="mudafoto"><label for="mudafoto">Mudar Foto:</label><input type="file" name="mudafoto" id="mudafoto"></div>
		<div class="mudatitulo"><label for="mudatitulo">Mudar Titulo:</label><input type="text" name="mudatitulo" id="mudatitulo" value="<?php echo $result['titulo']; ?>"></div>
		<div class="conteudonoticias">
			<p>Dicas: use a sintaxe do html para formatar o texto (tag p para paragrafos, h5 para um subtitulo, br para quebrar uma linha, etc...)</p>
			<label for="conteudo">Mudar conteudo:</label><textarea class="form-control" rows="5" name="conteudo" id="conteudo"><?php echo $result['conteudo'];?></textarea>
		</div>
		<div class="centraliz"><input type="submit" name="Editar" class="enviarnoticia" value="editar"></div>
	</form>
	
</div>


<?php
require_once("assets/inc/footer.php");
?>