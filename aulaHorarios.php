<?php
require_once('assets/inc/conexao.php');
require_once('assets/func/funcoes.php');
$sala = $_GET['ambiente'];
$turno = $_GET['turno'];

?>
<div class="tabelahorariosfixos">
<table border="1px">
	<thead>
		<td>Horarios</td>
		<td>Segunda</td>
		<td>Terça</td>
		<td>Quarta</td>
		<td>Quinta</td>
		<td>Sexta</td> 
	</thead>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '8:15';
				}
				else{
					if($turno=='Tarde'){
						echo '13:30';
					}
					else{
					echo '19:00';
					}
				}
				
			?>		
		</td>

		<td>
			<?php
				horarios($sala,$turno,'08:15','segunda',$conexao);
			?>
		</td>	


		<td>
			<?php
				horarios($sala,$turno,'08:15','terça',$conexao);
			?>
		</td>

		<td>
			<?php
				horarios($sala,$turno,'08:15','quarta',$conexao);
			?>
		</td>

		<td><?php
				horarios($sala,$turno,'08:15','quinta',$conexao);
			?>		
		</td>

		<td>
			<?php
				horarios($sala,$turno,'08:15','sexta',$conexao);
			?>
		</td>
	
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '9:00';
				}
				else{
					if($turno=='Tarde'){
						echo '14:15';
					}
					else{
					echo '19:45';
					}
				}	
			?>	
		</td>
		<td>
			<?php
				horarios($sala,$turno,'09:00','segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'09:00','terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'09:00','quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'09:00','quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'09:00','sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '10:00';
				}
				else{
					if($turno=='Tarde'){
						echo '15:00';
					}
					else{
						echo '20:30';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:00','segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:00','terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:00','quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:00','quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:00','sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '10:45';
				}
				else{
					if($turno=='Tarde'){
						echo '16:00';
					}
					else{
						echo '21:30';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:45','segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:45','terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:45','quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:45','quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'10:45','sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '11:30';
				}
				else{
					if($turno=='Tarde'){
						echo '16:45';
					}
					else{
						echo '22:45';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'11:30','segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'11:30','terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'11:30','quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'11:30','quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horarios($sala,$turno,'11:30','sexta',$conexao);
			?>
		</td>
	</tr>

</table>
</div>