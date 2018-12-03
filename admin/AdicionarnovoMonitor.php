<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarAluno'])){
$id_aluno = $_POST['id_aluno'];
$id_disciplina= $_POST['id_disciplina'];
$id_orientador = $_POST['id_orientador'];
	
$sql = "INSERT INTO monitores VALUES(default,'".$id_aluno."','".$id_disciplina."','".$id_orientador."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="O monitor adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="O monitor não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Monitores.php');
}
?>
<form method="post" action="AdicionarNovoMonitor.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Novo Monitor</h3>
	<label for="id_aluno">Aluno:</label><br>
		<?php 
			$sql1 = 'SELECT* FROM alunos';
			$resultado1 = mysqli_query($conexao,$sql1);
			$result1 = mysqli_fetch_all($resultado1,MYSQLI_ASSOC);

			echo '<select id="id_aluno" class="selectform" name="id_aluno"><option selected value="null">Selecione o Aluno</option>';
			foreach($result1 as $itens1){
				echo '<option value="'.$itens1['id'].'" name="id_aluno">'.$itens1['nome'].'</option>';
			};
			echo '</select>';
		?>
	<label for="id_disciplina">Disciplina:</label><br>
		<?php 
			$sql2 = 'SELECT* FROM disciplinas';
			$resultado2 = mysqli_query($conexao,$sql2);
			$result2 = mysqli_fetch_all($resultado2,MYSQLI_ASSOC);

			echo '<select id="id_disciplina" class="selectform" name="id_disciplina"><option selected value="null">Selecione a disciplina</option>';
			foreach($result2 as $itens2){
				echo '<option value="'.$itens2['id'].'">'.$itens2['nome'].'</option>';
			};
			echo '</select>';
		?>
	<label for="id_orientador">Orientador:</label><br>
		<?php 
			$sql3 = 'SELECT* FROM professores';
			$resultado3 = mysqli_query($conexao,$sql3);
			$result3 = mysqli_fetch_all($resultado3,MYSQLI_ASSOC);

			echo '<select id="id_orientador" class="selectform" name="id_orientador"><option selected value="null">Selecione orientador</option>';
			foreach($result3 as $itens3){
				echo '<option value="'.$itens3['id'].'">'.$itens3['nome'].'</option>';
			};
			echo '</select>';
		?>
	<input type="submit" name="AdicionarAluno" class="enviar">
</form>