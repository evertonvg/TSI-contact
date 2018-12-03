<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
if(isset($_POST['Enviar'])){
	$id = $_POST['id'];
	$dia = $_POST['dia'];
	$horario = $_POST['horario'];
	$turno = $_POST['turno'];
		

	$sql = "UPDATE horarios SET horario='".$horario."',turno='".$turno."',dia='".$dia."' WHERE id=".$id;
	$modificacao = mysqli_query($conexao,$sql);
	if($modificacao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Horário modificado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Horário não foi modificado - dados iguais.";
			$_SESSION['estilo'] = 'alert-warning';
		}
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a modificação. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}
	header('location:horarios.php');
}
else{
	$id = $_GET['id'];
	$sql = "SELECT* FROM horarios WHERE id=".$id;
	$resultado = mysqli_query($conexao,$sql);
	if($resultado ){
		$result = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar a consulta. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
		header('location:Horarios.php');
	}
}
?>
<form action="EditarHorario.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Dados do Horário</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label for="horario">horário:</label><input type="time" id="horario" name="horario" value="<?php echo $result['horario'];?>">
	<label for="turno">turno:</label>
	<select class="selectform" name="turno" id="turno">
		<option value="<?php echo $result['turno'];?>" selected><?php echo $result['turno'];?></option>
		<option value="Manhã">Manhã</option>
		<option value="Tarde">Tarde</option>
		<option value="Noite">Noite</option>
	</select>
	<label for="dia">dia:</label>
	<select class="selectform" name="dia" id="dia">
		<option value="<?php echo $result['dia'];?>" selected><?php echo $result['dia'];?></option>
		<option value="segunda">segunda</option>
		<option value="terça">terça</option>
		<option value="quarta">quarta</option>
		<option value="quinta">quinta</option>
		<option value="sexta">sexta</option>
		<option value="sabado">sabado</option>
		<option value="domingo">domingo</option>
	</select>

	
	

	
	<input type="submit" name="Enviar" value="Modificar" class="enviar"">
</form>