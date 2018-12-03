<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

if(isset($_POST['sim2'])){
	$id=$_POST['idUsuario'];
	$nome=$_POST['nomeUsuario'];
	$sql = "DELETE FROM usuarios WHERE id=".$id;
	$exclusao = mysqli_query($conexao,$sql);
	if($exclusao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Usuario ".$nome." removido com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';

			$pasta = "SELECT* FROM usuarios WHERE id=".$id;
			$selecao = mysqli_query($conexao,$pasta);
			if($selecao){
				if(mysqli_num_rows($selecao)>=1){
					$selecaoo = mysqli_fetch_array($selecao,MYSQLI_ASSOC);
					$cam =  $selecaoo['foto'];
					if( $selecaoo['foto']!=''){
						unlink('../'.$cam);
						$exp = explode('/', $cam);
						$count = count($exp);
						unset($exp[$count-1]);
						$pastaa=implode('/', $exp);
						rmdir('../'.$pastaa);
						//ver essa parte dps
					}
					else{
						$exp = explode('/', $cam);
						$count = count($exp);
						unset($exp[$count-1]);
						$pastaa=implode('/', $exp);
						rmdir('../'.$pastaa);
					}
				}
			}
		}
		else{
			$_SESSION['mensagem']="Usuario ".$nome." não pode ser deletado.";
			$_SESSION['estilo'] = 'alert-warning';
		}	
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a exclusão do Usuario. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Usuarios.php');
}
else{
	$id=$_GET['id'];
	$nome=$_GET['nome'];	
}
?>
<form method="post" action="excluir_usuario.php">
	<input type="hidden" name="nomeUsuario" value="<?php echo $nome; ?>">
	<input type="hidden" name="idUsuario" value="<?php echo $id; ?>">
	<a href="#" id="fechar">Fechar</a>
	<h3>Você realmente deseja excluir o usuário <?php echo $nome;?></h3>
	<input type="submit" name="sim2" value="SIM" class="sim2">
	<input type="submit" name="nao2" value="NAO" class="nao2" id="nao2">
</form>