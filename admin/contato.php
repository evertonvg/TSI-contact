<?php
require "../assets/inc/conexao.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;	
if (isset($_POST['enviar'])) {
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/SMTP.php";

$nome = $_POST['nome'];
$email = 'evertoniee@yahoo.com.br';
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$email_resposta = $_POST['email_resposta'];
    $mail = new PHPMailer();  
    $mail->SetLanguage("br"); 
    $mail->IsSMTP(); 
    $mail->IsHTML(true); 
    $mail->SMTPDebug = 0;  
    $mail->SMTPAuth = true;  
    $mail->SMTPSecure = 'tls'; 

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; 
    $mail->Username = 'dawexemplo2014@gmail.com';
    $mail->Password = 'senha52014';
    $mail->CharSet = "utf-8";

    $mail->SetFrom('dawexemplo2014@gmail.com');
    $mail->AddAddress($email); 
	$mail->addReplyTo($email_resposta);
    $mail->Subject = $assunto;
    $mail->Body = 'Nome:'.$nome.'<br>'.$mensagem . "<br> Enviado por: ".$email_resposta ;

    if(!$mail->Send()){
        $message = "PhpMailer Gmail status: ".$mail->ErrorInfo;
        $_SESSION['estilo']='alert-danger';
    } else {
        $message = "E-mail enviado com sucesso";
        $_SESSION['estilo']='alert-success';
 	}
 	$_SESSION['mensagem']=$message;
 	header('location:admin.php');
}
?>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Enviar E-mail</title>
 </head>
 <body>
 	<div id="email_result"></div>
<form action="contato.php" method="post" name="frm_contato" class="forme">
    <a href="#" id="fechar">Fechar</a>
	<h3>Como podemos ajudar?</h3>
	<label for="nome">Nome:</label><input type="text" name="nome" id="nome"><br>
	<label for="email_resposta">Email:</label><input type="email" name="email_resposta" id="email_resposta"><br>
	<label for="assunto">Assunto:</label><input type="text" name="assunto" id="assunto"><br>
	<label for="mensagem">Sua mensagem:</label><br><textarea id="mensagem" class="mensagem" name="mensagem" rows="5"></textarea>
	<input type="submit" name="enviar" value="ENVIAR" class="enviar" id="contato_2">
</form>
<body>