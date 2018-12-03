<?php
session_start();

$user='root';
$password='klapaucius';
$database='if_contact';
$localhost='localhost';

$conexao=mysqli_connect($localhost,$user,$password,$database);
if(!$conexao){
	echo "<script>alert('erro de conexão com o banco de dados!erro:".mysqli_connect_error()."');</script>";
}
?>