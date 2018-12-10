<?php
require_once("../assets/inc/conexao.php");
require_once("assets/inc/header.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT id,titulo,conteudo,foto,DATE_FORMAT(data_hora,'%d/%m/%Y') as dia,DATE_FORMAT(data_hora,'%H:%i:%s') as hora FROm noticias order by data_hora desc";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	echo 	'<a href="Adicionarnovapublicacao.php" class="btn btn-success haha" id="Adicionarnovapublicacao" >Nova Públicação</a><br>
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>';

	if($count>'0'){
		echo 	'
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>PUBLICAÇÔES</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">noticia</th>
				      <th scope="col">dia</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
		echo 	'<tr>
					<td>'.$linha['titulo'].'</td>
					<td>'.$linha['dia'].'</td>
					<td>
						<a href="../noticias.php?id='.$linha['id'].'" class="btn btn-success" target="_blank">Visualizar</a>
						<a href="editar_noticia.php?id='.$linha['id'].'" class="btn btn-primary" id="editar_noticia">Editar</a>
						<a href="excluir_noticia.php?id='.$linha['id'].'&nome='.$linha['titulo'].'" class="btn btn-danger" id="excluir_noticia" rel="modal2" data-janela="#janela1">Excluir</a></td>
				</tr>';
		}
		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		 echo '<div class="dashboards">
					<div class="bemvindo"> 
						<h4>Não existem noticias publicadas!</h4>
					</div>
				</div>';
	}
}
else{
	$erro = mysqli_error($conexao);
	$_SESSION['mensagem']="Não foi possivel fazer a requisição! Por favor volte mais tarde. Erro: ".$erro;
	$_SESSION['estilo'] = 'alert-danger';
	header('location:admin.php');
}
?>


<?php
require_once("assets/inc/footer.php");
?>