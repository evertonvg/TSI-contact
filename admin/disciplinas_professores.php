<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM disciplina_professor";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'<a href="AdicionarNovaDisciplinaProfessor.php" class="btn btn-success haha" 	id="AdicionarNovaDisciplina" rel="modal2" data-janela="#janela1">Adicionar nova relação</a><br>
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>DISCIPLINAS ~ PROFESSORES</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">Disciplina</th>
				      <th scope="col">Professor</th>
				     
				      <th scope="col">operações</th>
				    </tr>
				  </thead>';		
		foreach ($result as $linha){
			$sql1 = 'SELECT* FROM disciplinas WHERE id='.$linha['id_disciplina'];
			$resultado1 = mysqli_query($conexao,$sql1);
			$resultadoo = mysqli_fetch_array($resultado1,MYSQLI_ASSOC);

			$sql2 = 'SELECT* FROM professores WHERE id='.$linha['id_professor'];
			$resultado2 = mysqli_query($conexao,$sql2);
			$resultadooo = mysqli_fetch_array($resultado2,MYSQLI_ASSOC);


			echo 	'<tr>
						<td>'.$resultadoo['nome'].'</td>
						<td>'.$resultadooo['nome'].'</td>
						<td>
							<a href="EditarDisciplinaProfessor.php?id='.$linha['id'].'" class="btn btn-primary" id="Editar_DP" rel="modal2" data-janela="#janela1">Editar</a>
							<a href="ExcluirDisciplinaProfessor.php?id='.$linha['id'].'" class="btn btn-danger" id="Editar_DP" rel="modal2" data-janela="#janela1">Excluir</a>
							</td>
					</tr>';
			}

		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		$_SESSION['mensagem']="Não existem usuarios cadastrados";
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