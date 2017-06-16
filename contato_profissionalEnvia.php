<?

if (isset($_POST[Submit]))
{

$destinatarios = 'vagas@excelenciarh.com.br';
$nomeDestinatario = 'Excelencia RH';
$usuario = 'clientes@excelenciarh.com.br';
$senha = 'excel1111';

/*abaixo as veriaveis principais, que devem conter em seu formulario*/

$assunto = '[Formulario do Site] Envio de CV';

$_POST['mensagemRemetente'] = nl2br(
'<strong>Nome: </strong>'. $_POST['nomeRemetente'] ."
". '<strong>E-mail: </strong>'. $_POST['emailRemetente'] ."
". '<strong>Celular: </strong>'. $_POST['celularRemetente'] ."
". '<br>' ."
". '<strong>Mensagem: </strong>'. $_POST['mensagemRemetente']);


/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/

include_once("phpmailer/class.phpmailer.php");

$To = $destinatarios;
$Subject = $assunto;
$Message = $_POST['mensagemRemetente'];

$Host = 'smtp.excelenciarh.com.br';
$Username = $usuario;
$Password = $senha;
$Port = "587";

$mail = new PHPMailer();
$body = $Message;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host = $Host; // SMTP server
$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Port = $Port; // set the SMTP port for the service server
$mail->Username = $Username; // account username
$mail->Password = $Password; // account password

$mail->SetFrom($usuario, $nomeDestinatario);
$mail->Subject = $Subject;
$mail->MsgHTML($body);
$mail->AddAddress($To, "");

// Upload File Function \\

	$target_path = "cv/";
	$filename = $_FILES['firstFile']['name'];
	$target_path = $target_path . basename($filename);
	if(move_uploaded_file($_FILES['firstFile']['tmp_name'], $target_path)) {
		
		// Define os anexos (opcional)
		//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		$mail->AddAttachment("cv/".$filename, $filename);
		
		
		// Exibe uma mensagem de resultado
		if (!$mail->Send()) {
			print "<meta http-equiv='refresh' content='0;URL=obrigado.html'>";
		} 
	} else {
		print "<meta http-equiv='refresh' content='0;URL=erro.html'>";
	  }
	  
	  print "<meta http-equiv='refresh' content='0;URL=obrigado.html'>";

}
?>