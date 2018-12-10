<?php
require_once('assets/inc/conexao.php');
require_once('assets/inc/header.php');
$id = $_GET['id'];
$sql = "SELECT id,titulo,conteudo,foto,DATE_FORMAT(data_hora,'%d/%m/%Y') as dia,DATE_FORMAT(data_hora,'%H:%i:%s') as hora FROm noticias WHERE id=".$id;
$request = mysqli_query($conexao,$sql);
$linha = mysqli_fetch_array($request,MYSQLI_ASSOC);
?>
<div class="principal">
	<div class="cabecalhonoticia" style="background-image:url('<?php echo $linha['foto']; ?>');">
		<div class="titulo"><h3><?php echo  $linha['titulo']; ?></h3><h5>públicado dia <?php echo $linha['dia'];?> ás <?php echo $linha['hora'];?></h5></div>
	</div>
	<div class="conteudonoticias">
		<p><?php echo $linha['conteudo'];?></p>
	</div>
</div>
<?php
require_once('assets/inc/footer.php');
?>