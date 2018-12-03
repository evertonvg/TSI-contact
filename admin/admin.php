<?php
require_once("../assets/inc/conexao.php");
if(!$_SESSION['admin']){
	header('location:../ops.php');
}
require_once("assets/inc/header.php");
?>
<div class="dashboards" >
	<div class="bemvindo"> 
		<h4>DASHBOARD</h4>
	</div>
	<div>
		<ul class="dashh" ">
			<li><a href="Alunos.php">Alunos</a></li>
			<li><a href="Monitores.php">Monitores</a></li>
			<li><a href="Professores.php">Professores</a></li>
			<li><a href="Ambientes.php">Ambientes</a></li>
			<li><a href="TiposUsuarios.php">Tipos de usuarios</a></li>
			<li><a href="Disciplinas.php">Disciplinas</a></li>
			<li><a href="Horarios.php">Horários</a></li>
			<li><a href="Semestres.php">Semestres</a></li>
			<li><a href="Usuarios.php">Usuarios</a></li>
			<li><a href="disciplinas_professores.php">disciplina / professor</a></li>
			<li><a href="ambientes_horarios_disciplinas.php">ambientes / horários</a></li>
			
		</ul>
	</div>
	<div>
		
	</div>
	
</div>

<?php
require_once("assets/inc/footer.php");
?>
