<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM monitores";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'<a href="AdicionarNovoMonitor.php" class="btn btn-success haha" id="AdicionarNovoMonitor" rel="modal" data-janela="#janela1">Adicionar Monitor aluno</a><br>
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>Monitores</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">monitor</th>
				      <th scope="col">disciplina</th>
				      <th scope="col">orientador</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
			$sql1 = 'SELECT* FROM alunos WHERE id='.$linha['id_aluno'];
			$consulta1 = mysqli_query($conexao,$sql1);
			$itens1 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);

			$sql2 = 'SELECT* FROM disciplinas WHERE id='.$linha['id_disciplina'];
			$consulta2 = mysqli_query($conexao,$sql2);
			$itens2 = mysqli_fetch_array($consulta2,MYSQLI_ASSOC);

			$sql3 = 'SELECT* FROM professores WHERE id='.$linha['id_orientador'];
			$consulta3 = mysqli_query($conexao,$sql3);
			$itens3 = mysqli_fetch_array($consulta3,MYSQLI_ASSOC);

			echo 	'<tr>
						<td>'.$itens1['nome'].'</td>
						<td>'.$itens2['nome'].'</td>
						<td>'.$itens3['nome'].'</td>
						<td><a href="visualizar_monitor.php?id='.$linha['id'].'" class="btn btn-info" id="visualizar_monitor">Visualizar Perfil do Monitor</a>
							<a href="EditarMonitor.php?id='.$linha['id'].'" class="btn btn-primary" id="Editar_Monitor" rel="modal2" data-janela="#janela1">Editar</a>
							<a href="excluir_monitor.php?id='.$linha['id'].'&nome='.$itens1['nome'].'" class="btn btn-danger" id="excluir_monitor" rel="modal2" data-janela="#janela1">Excluir</a></td>
					</tr>';
			}

		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		$_SESSION['mensagem']="Não existem monitores cadastrados";
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