<?php
require_once('assets/inc/conexao.php');
require_once('assets/inc/header.php');
$sql = "SELECT id,titulo,conteudo,foto,DATE_FORMAT(data_hora,'%d/%m/%Y') as dia,DATE_FORMAT(data_hora,'%H:%i:%s') as hora FROm noticias order by data_hora desc";
$result = mysqli_query($conexao,$sql);
$linhas = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>

<div class="listanoticias">

	<?php
		foreach($linhas as $linha){
			echo '<a href="noticias.php?id='.$linha['id'].'" title="'.$linha['titulo'].'"><div class="elementoimagemnoticia" style="background-image:url('.$linha['foto'].');"></div>
				<div class="elementodianoticia">'.$linha['dia'].'</div>
				<div class="elementotitulonoticia"><h5>'.$linha['titulo'].'</h5></div></href>';
		}
	?>
</div>
<?php
require_once('assets/inc/footer.php');
?>