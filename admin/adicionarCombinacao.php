<?php
require_once("../assets/inc/conexao.php");
if(isset($_POST['AdicionarAmbiente'])){
$nome = $_POST['NomeAmbiente'];
$referencia = $_POST['referencia'];
	
$sql = "INSERT INTO horarios_ambiente_disciplina_professor VALUES(default,'".$nome."','".$referencia."')";

$insercao = mysqli_query($conexao,$sql);

	//var_dump($insercao);
	//die();
	if($insercao){
		$linhas_afetadas = mysqli_affected_rows($conexao);
		
		if($linhas_afetadas>='1'){
			$_SESSION['mensagem']="Ambiente ".$nome." adicionado com sucesso!.";
			$_SESSION['estilo'] = 'alert-success';
		}
		else{
			$_SESSION['mensagem']="Ambiente ".$nome." não pode ser adicionado.";
			$_SESSION['estilo'] = 'alert-warning';
		}
		
	}
	else{
		$erro = mysqli_error($conexao);
		$_SESSION['mensagem']="Não foi possivel realizar o registro! Por favor volte mais tarde. Erro: ".$erro;
		$_SESSION['estilo'] = 'alert-danger';
	}

	header('location:Ambientes.php');
}
?>
<form method="post" action="AdicionarnovoAmbiente.php">
	<a href="#" id="fechar">Fechar</a>
	<h3>Adicionar Nova combinação</h3>

	<label for="horario">Horário:</label>
	<select class="selectform">
			<?php
				$sql = "SELECT* FROM horarios";
				$results = mysqli_query($conexao,$sql);
				$linha = mysqli_fetch_array($results,MYSQLI_ASSOC);
				foreach ($linha as $valor) {
					echo '<option value="'..'">'..'</option>';
				}
			?>
	</select>
	

	
	<input type="submit" name="AdicionarAmbiente" class="enviar">
</form>