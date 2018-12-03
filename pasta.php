<?php 
$nomePasta = 'Everton';
if(mkdir('usuariosPastas/'.$nomePasta)){
	echo 'ok';
}
else{
	echo 'fail';
}
?>