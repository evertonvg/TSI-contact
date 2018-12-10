<?php
require_once('assets/inc/conexao.php'); 
require_once('assets/inc/header.php');
 
$id=$_GET['id'];

$sql = 'SELECT* FROM usuarios WHERE id='.$id;
$consulta = mysqli_query($conexao,$sql);
$linha = mysqli_fetch_array($consulta,MYSQLI_ASSOC);

if($linha['tipo_usuario']=='1'){
				$userr = 'Professor';
				$sql1 = 'SELECT* FROM professores WHERE id='.$linha['info'];
				$consulta1 = mysqli_query($conexao,$sql1);
				$itens = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
			}
			else{
				if($linha['tipo_usuario']=='2'){
					$userr = 'Aluno';
					$sql1 = 'SELECT* FROM alunos WHERE id='.$linha['info'];
					$consulta1 = mysqli_query($conexao,$sql1);
					$itens = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
				}
				else{
					$userr = 'Monitor';
					$sql1 = 'SELECT* FROM monitores WHERE id='.$linha['info'];
					$consulta1 = mysqli_query($conexao,$sql1);
					$itens2 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);

					$sql2 = 'SELECT* FROM alunos WHERE id='.$itens2['id_aluno'];
					$consulta2 = mysqli_query($conexao,$sql2);
					$itens = mysqli_fetch_array($consulta2,MYSQLI_ASSOC);
				}
			}
?>
<div class="fundopreto"></div>

<form action="dadosDoPerfil.php" method="post" id="formloco" enctype="multipart/form-data">
<div class="cabeca_perfil">
	
	<div class="foto_perfil">
		<img src="<?php if($linha['foto']==''){echo 'assets/img/desconhecido.jpg';}else{echo $linha['foto'];} ?>" width="200px" id="src_perfil"	 >
		<div class="upload_div">
			<input id="upload_file" type="file" name="foto" />
			<a href="#" id="upload_link">Envie sua foto</a>​
		</div>
	</div>
	<div class="nome_perfil">
		<h1><?php echo $userr;?> <?php echo $itens['nome'];?></h1>
		<h2>(<?php echo $linha['apelido'].')'; if($linha['admin']=='1'){echo '<img src="assets/img/coroa.png">';} ?></h2>
		<h5> <?php if($userr=='Aluno' or $userr=='Monitor'){echo 'Número de matricula:'.$itens['matricula'];}else{echo 'Número de siape:'.$itens['siape'];}?></h5>

			<?php if(($userr=='Monitor' OR $userr=='Professor')AND($id==$_SESSION['id'])){echo '<a href="#" class="btn btn-warning botaoooo">definir horários</a>';}
			if($id==$_SESSION['id']){
				echo '<a href="modificar_senha.php?id='.$_SESSION['id'].'" class="btn btn-success botaooo" rel="modal2" data-janela="#janela1" id="modificar">modificar senha</a>
				<a href="#" class="btn btn-primary botaoo" id="editar">editar perfil</a>
				<input type="submit" class="btn btn-success botaooooo hidden" value="Salvar perfil" id="salvar">
				<a href="#" class="btn btn-danger botaoo hidden" id="cancelar">Cancelar</a>';
			}
			?> 	
	</div>
</div>

<div class="dados">
	<p class="dados_usuario"><label for="apelido" id="paragrafoapelido" class="hidden">Apelido:</label><input type="text" class="hidden" name="apelido" id="apelido"  value="<?php echo $linha['apelido'];?>"></p>
	<p class="dados_usuario"><label for="email">Email:</label><input type="email" name="email" id="email" readonly value="<?php echo $linha['email'];?>"></p>
	<p class="dados_usuario"><label for="wpp">WhatsApp/Celular:</label><input type="number" name="wpp" id="wpp"
		readonly value="<?php echo $linha['wpp_celular'];?>"></p>
	
</div>
</form>



<?php
require_once('assets/inc/footer.php');
?>