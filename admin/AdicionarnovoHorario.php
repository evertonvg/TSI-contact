<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarHorario'])){
$horario = $_POST['horario'];
$dia = $_POST['dia'];
$turno = $_POST['turno'];
	
$sql = "INSERT INTO horarios VALUES(default,'".$horario."','".$turno."','".$dia."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="horário adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="horário não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Horarios.php');
}
?>
<form action="AdicionarnovoHorario.php" method="post">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar novo Horário</h3>
	<label for="horario">horário:</label><input type="time" id="horario" name="horario">
	<label for="turno">turno:</label>
	<select class="selectform" name="turno" id="turno">
		<option value="">Selecione o turno</option>
		<option value="Manhã">Manhã</option>
		<option value="Tarde">Tarde</option>
		<option value="Noite">Noite</option>
	</select>
	<label for="dia">dia:</label>
	<select class="selectform" name="dia" id="dia">
		<option value="">Selecione o dia</option>
		<option value="segunda">segunda</option>
		<option value="terça">terça</option>
		<option value="quarta">quarta</option>
		<option value="quinta">quinta</option>
		<option value="sexta">sexta</option>
		<option value="sabado">sabado</option>
		<option value="domingo">domingo</option>
	</select>
	
	<input type="submit" name="AdicionarHorario" value="Adicionar" class="enviar">
</form>