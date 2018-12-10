<?php 
require_once("../assets/inc/conexao.php");
require_once('../assets/func/funcoes.php');
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
$sala = $_GET['ambiente'];
$turno = $_GET['turno'];

?>
<div class="tabelahorariosfixosadmin">
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
					$hora = '8:15';
				}
				else{
					if($turno=='Tarde'){
						echo '13:30';
						$hora = '13:30';
					}
					else{
					echo '19:00';
					$hora = '19:00';
					}
				}
				
			?>		
		</td>

		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'segunda',$conexao);
			?>
		</td>	


		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'terça',$conexao);
			?>
		</td>

		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quarta',$conexao);
			?>
		</td>

		<td><?php
				horariosadmin($sala,$turno,$hora,'quinta',$conexao);
			?>		
		</td>

		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'sexta',$conexao);
			?>
		</td>
	
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '9:00';
					$hora = '9:00';
				}
				else{
					if($turno=='Tarde'){
						echo '14:15';
						$hora = '14:15';
					}
					else{
						echo '19:45';
						$hora = '19:45';
					}
				}	
			?>	
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '10:00';
					$hora = '10:00';
				}
				else{
					if($turno=='Tarde'){
						echo '15:00';
						$hora = '15:00';
					}
					else{
						echo '20:30';
						$hora = '20:30';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '10:45';
					$hora = '10:45';
				}
				else{
					if($turno=='Tarde'){
						echo '16:00';
						$hora = '16:00';
					}
					else{
						echo '21:30';
						$hora = '21:30';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'sexta',$conexao);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($turno=='Manhã'){
					echo '11:30';
					$hora = '11:30';
				}
				else{
					if($turno=='Tarde'){
						echo '16:45';
						$hora = '16:45';
					}
					else{
						echo '22:15';
						$hora = '22:15';
					}
				}
				
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'segunda',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'terça',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quarta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'quinta',$conexao);
			?>
		</td>
		<td>
			<?php
				horariosadmin($sala,$turno,$hora,'sexta',$conexao);
			?>
		</td>
	</tr>

</table>
</div>