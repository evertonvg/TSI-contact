<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$disciplina_professor = $_POST['diprof'];
	
	


	$sql = "UPDATE horarios_ambiente_disciplina_professor SET disciplina_professor='".$disciplina_professor."'WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="requisição completada com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="requisição  não foi completada - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:ambientes_horarios_disciplinas.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM horarios_ambiente_disciplina_professor WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:ambientes_horarios_disciplinas.php');
	}
}
?>
<form action="Editarcombinacao.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do horário:</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">

			<?php
				$sql = "SELECT* FROM horarios WHERE id=".$result['horario'];
				$results = mysqli_query($conexao,$sql);
				$linha = mysqli_fetch_array($results,MYSQLI_ASSOC);
			?>

	<label for="horario">Horário(somente leitura):</label><input type="time" name="horario" id="horario" value="<?php echo $linha['horario']?>" readonly>


			<?php
				$sql = "SELECT* FROM ambientes WHERE id=".$result['ambiente'];
				$results = mysqli_query($conexao,$sql);
				$linha = mysqli_fetch_array($results,MYSQLI_ASSOC);
			?>
				

	<label for="ambiente">Ambiente(somente leitura):</label><input type="text" name="ambiente" id="ambiente" value="<?php echo $linha['referencia']?>" readonly> 

	<label for="disciplina_professor">Professor - Disciplina:</label>
		<select class="selectform" name="diprof">
			<?php
				$sl = "SELECT* FROM horarios_ambiente_disciplina_professor WHERE id=".$id;
				$resul = mysqli_query($conexao,$sl);
				$linhaa = mysqli_fetch_array($resul,MYSQLI_ASSOC);


				$sql = "SELECT* FROM disciplina_professor";
				$results = mysqli_query($conexao,$sql);
				$linhas = mysqli_fetch_all($results,MYSQLI_ASSOC);
				foreach ($linhas as $linha) {
					$sql1 = "SELECT* from professores WHERE id=".$linha['id_professor'];
					$resultts = mysqli_query($conexao,$sql1);
					$lin = mysqli_fetch_array($resultts,MYSQLI_ASSOC);

					$sql2 = "SELECT* from disciplinas WHERE id=".$linha['id_disciplina'];
					$resulttts = mysqli_query($conexao,$sql2);
					$linh = mysqli_fetch_array($resulttts,MYSQLI_ASSOC);

					echo '<option value="'.$linha['id'].'"';
					if ($linhaa['disciplina_professor']==$linha['id']){
						echo 'selected';
					}
					echo '>'.$lin['nome'].' - '.$linh['nome'].'</option>';
				}
			?>
		</select>		
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>