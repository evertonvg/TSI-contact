<?php
	function horarios($sala,$turno,$horario,$dia,$conexao){
		$sqlcasa = $slq = "SELECT horarios_ambiente_disciplina_professor.ambiente,horarios.horario,horarios.turno,disciplinas.nome,	professores.nome FROM horarios_ambiente_disciplina_professor 
					LEFT JOIN horarios ON (horarios_ambiente_disciplina_professor.horario=horarios.id)
					LEFT JOIN disciplina_professor ON (horarios_ambiente_disciplina_professor.disciplina_professor=	disciplina_professor.id)
					LEFT JOIN disciplinas ON (disciplina_professor.id_disciplina=disciplinas.id)
					LEFT JOIN professores ON (disciplina_professor.id_professor=professores.id)
					WHERE horarios_ambiente_disciplina_professor.ambiente='".$sala."'
					AND horarios.turno='".$turno."' AND horarios.horario='".$horario."' AND horarios.dia='".$dia."'";

				$resultado = mysqli_query($conexao,$sqlcasa);
				$linha = mysqli_fetch_array($resultado);
				// echo json_encode($linha);
				if(($linha['3']=='')&& ($linha['4']=='')){
					echo 'Vago';
				}
				else{
					echo '<div class="materia">'.$linha['3'].'</div>';
					echo '<div class="profess">'.$linha['4'].'</div>';
				}
				
	}

	function selectambiente($conexao){
		$sql = "SELECT* FROM ambientes";
		$result = mysqli_query($conexao,$sql);
		$linha = mysqli_fetch_all($result,MYSQLI_ASSOC);
		echo '<select class="ppp" id="ambiente" name="ambiente">';
		echo '<option value="" selected>Selecione o Lab</option>';
		foreach($linha as $linhaa){
			echo '<option value="'.$linhaa['id'].'">'.$linhaa['referencia'].'</option>';
		}
		echo '</select>';
	}
?>