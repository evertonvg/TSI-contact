<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM horarios_ambiente_disciplina_professor";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'
				<div class="botao_esquerda">
					<a href="adicionarCombinacao.php" class="btn btn-success haha" id="adicionarCombinacao" rel="modal2" data-janela="#janela1">Adicionar Combinação</a><br>
					<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				</div>
				<div class="botao_direita">
					<select class="ppp" id="ambiente">
						<option value="1">lab 1</option>
						<option value="2">lab 2</option>
						<option value="3">lab 3</option>
						<option value="4">lab 4</option>
						<option value="5">lab 5</option>
						<option value="6">lab 6</option>
						<option value="" selected>Selecione o Lab</option>
					</select>
					<select class="ppp" id="dia">
						<option value="">Selecione o Dia</option>
						<option value="segunda">Segunda</option>
						<option value="terça">Terça</option>
						<option value="quarta">Quarta</option>
						<option value="quinta">Quinta</option>
						<option value="sexta">Sexta</option>
						<option value="sabado">Sabado</option>
					</select>
					<select class="ppp" id="turno">
						<option value="">Selecione o Turno</option>
						<option value="Manhã">Manhã</option>
						<option value="Tarde">Tarde</option>
						<option value="Noite">Noite</option>
					</select>
					
				</div>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>HORARIOS DE SALAS</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">Horário</th>
				      <th scope="col">Dia</th>
				      <th scope="col">Turno</th>
				      <th scope="col">Sala</th>
				      <th scope="col">Disciplina</th>
				      <th scope="col">Professor</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
			$sql1 = "SELECT* FROM horarios where id=".$linha['horario'];
			$resultado1 = mysqli_query($conexao,$sql1);
			$result1 = mysqli_fetch_array($resultado1);

			$sql2 = "SELECT* FROM ambientes where id=".$linha['ambiente'];
			$resultado2 = mysqli_query($conexao,$sql2);
			$result2 = mysqli_fetch_array($resultado2);

			$sql3 = "SELECT* FROM disciplina_professor where id=".$linha['disciplina_professor'];
			$resultado3 = mysqli_query($conexao,$sql3);
			$result3 = mysqli_fetch_array($resultado3);

			$sql4 = "SELECT* FROM disciplinas where id=".$result3['id_disciplina'];
			$resultado4 = mysqli_query($conexao,$sql4);
			$result4 = mysqli_fetch_array($resultado4);

			$sql5 = "SELECT* FROM professores where id=".$result3['id_professor'];
			$resultado5 = mysqli_query($conexao,$sql5);
			$result5 = mysqli_fetch_array($resultado5);
	 

			echo 	'<tr id="linhaa">
						<td>'.$result1['horario'].'</td>
						<td id="colunadia">'.$result1['dia'].'</td>
						<td id="colunaturno">'.$result1['turno'].'</td>
						<td>'.$result2['referencia'].'</td>
						<td>'.$result4['nome'].'</td>
						<td>'.$result5['nome'].'</td>
						<td>
							<a href="Editarcombinacao.php?id='.$linha['id'].'" class="btn btn-primary" id="Editar_Monitor" rel="modal2" data-janela="#janela1">Editar</a>
							<a href="excluircombinacao.php?id='.$linha['id'].'" class="btn btn-danger" id="excluir_monitor" rel="modal2" data-janela="#janela1">Excluir</a></td>
					</tr>';
			}

		echo	'</table>
				</div>
				</div>';
		
	}
	else{
		$_SESSION['mensagem']="Não existem itens cadastrados";
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