<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM semestres";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'<a href="AdicionarNovoSemestre.php" class="btn btn-success haha" id="AdicionarNovoSemestre" rel="modal" data-janela="#janela1">Adicionar semestre</a><br>
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>SEMESTRES</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">id</th>
				      <th scope="col">descrição</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
		echo 	'<tr>
					<td>'.$linha['id'].'</td>
					<td>'.$linha['descricao'].'</td>
					<td>
						<a href="editar_semestre.php?id='.$linha['id'].'" class="btn btn-primary" id="editar_semestre" rel="modal2" data-janela="#janela1">Editar</a>
						<a href="excluir_semestre.php?id='.$linha['id'].'&nome='.$linha['descricao'].'" class="btn btn-danger" id="excluir_semestre" rel="modal2" data-janela="#janela1">Excluir</a></td>
				</tr>';
		}
		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		$_SESSION['mensagem']="Não existem semestres cadastrados";
		$_SESSION['estilo'] = 'alert-warning';
		header('location:admin.php');
	}
}
else{
	$erro = mysqli_error($conexao);
	$_SESSION['mensagem']="Não foi possivel fazer a requisição! Por favor volte mais tarde. Erro: ".$erro;
	$_SESSION['estilo'] = 'alert-danger';
	header('location:admin.php');
}
require_once("assets/inc/footer.php");
?>