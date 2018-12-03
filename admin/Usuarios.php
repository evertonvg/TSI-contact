<?php
require_once("assets/inc/header.php");
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}

$sql = "SELECT* FROM usuarios";
$resultado = mysqli_query($conexao,$sql);


if($resultado){
	$result=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
	$count = mysqli_num_rows($resultado);

	if($count>'0'){
		echo 	'
				<a href="admin.php" class="btn btn-primary haha" id="voltar">dashboard</a>
				<div class="dashboards">
					<div class="bemvindo"> 
						<h4>USUARIOS</h4>
					</div>
				<div class="espacoTab">';
		echo    '<table  class="table table-bordeless table-hover">

				<thead class="theadblack">
				    <tr>
				      <th scope="col">Nome</th>
				      <th scope="col">Tipo de usuario</th>
				      <th scope="col">Apelido</th>
				      <th scope="col">Email</th>
				      <th scope="col">operações</th>
				    </tr>
				  </thead>'	;		
		foreach ($result as $linha){
			if($linha['tipo_usuario']=='1'){
				$userr = 'Professor';
				$sql1 = 'SELECT* FROM professores WHERE id='.$linha['info'];
				$consulta1 = mysqli_query($conexao,$sql1);
				$itens1 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
			}
			else{
				if($linha['tipo_usuario']=='2'){
					$userr = 'Aluno';
					$sql1 = 'SELECT* FROM alunos WHERE id='.$linha['info'];
					$consulta1 = mysqli_query($conexao,$sql1);
					$itens1 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);
				}
				else{
					$userr = 'Monitor';
					$sql1 = 'SELECT* FROM monitores WHERE id='.$linha['info'];
					$consulta1 = mysqli_query($conexao,$sql1);
					$itens2 = mysqli_fetch_array($consulta1,MYSQLI_ASSOC);

					$sql2 = 'SELECT* FROM alunos WHERE id='.$itens2['id_aluno'];
					$consulta2 = mysqli_query($conexao,$sql2);
					$itens1 = mysqli_fetch_array($consulta2,MYSQLI_ASSOC);
				}
			}
	 

			echo 	'<tr>
						<td>'.$itens1['nome'].'</td>
						<td>'.$userr.'</td>
						<td>'.$linha['apelido'].'</td>
						<td>'.$linha['email'].'</td>
						<td><a href="visualizar_usuario.php?id='.$linha['id'].'" class="btn btn-info" id="visualizar_monitor">Visualizar Perfil do usuario</a>
							<a href="Editarusuario.php?id='.$linha['id'].'&nome='.$linha['apelido'].'" class="btn btn-primary" id="Editar_Monitor" rel="modal2" data-janela="#janela1">Editar</a>
							<a href="excluir_usuario.php?id='.$linha['id'].'&nome='.$linha['apelido'].'" class="btn btn-danger" id="excluir_monitor" rel="modal2" data-janela="#janela1">Excluir</a></td>
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