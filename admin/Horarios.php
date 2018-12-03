<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM horarios";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'
				<a href="AdicionarnovoHorario.php" class="btn btn-success haha" id="AdicionarnovoHorario" rel="modal" data-janela="#janela1">Adicionar horários</a><br>
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>HORÁRIOS</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">Horário</th>
				      <th scope="col">Turno</th>
				      <th scope="col">Dia</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
			

			echo 	'<tr>
						<td>'.$linha['horario'].'</td>
						<td>'.$linha['turno'].'</td>
						<td>'.$linha['dia'].'</td>
						
						<td>
							<a href="EditarHorario.php?id='.$linha['id'].'&horario='.$linha['horario'].'&dia='.$linha['dia'].'" class="btn btn-primary" id="EditarHorario" rel="modal2" data-janela="#janela1">Editar</a>
							<a href="excluir_horario.php?id='.$linha['id'].'&horario='.$linha['horario'].'&dia='.$linha['dia'].'" class="btn btn-danger" id="excluir_horario" rel="modal2" data-janela="#janela1">Excluir</a></td>
					</tr>';
			}

		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		$_SESSION['mensagem']="Não existem horarios cadastrados";
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