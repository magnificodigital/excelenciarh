<?

if (isset($_POST[Submit]))
{

$destinatarios = 'clientes@excelenciarh.com.br';
$nomeDestinatario = 'Excelencia RH';
$usuario = 'clientes@excelenciarh.com.br';
$senha = 'excel1111';


/*abaixo as veriaveis principais, que devem conter em seu formulario*/

$assunto = '[Formulario do Site] Contato';

$_POST['mensagemRemetente'] = nl2br(
'<strong>Nome: </strong>'. $_POST['nomeRemetente'] ."
". '<strong>Empresa: </strong>'. $_POST['empresaRemetente'] ."
". '<strong>E-mail: </strong>'. $_POST['emailRemetente'] ."
". '<strong>Telefone: </strong>'. $_POST['telefoneRemetente'] ."
". '<strong>Celular: </strong>'. $_POST['celularRemetente'] ."
". '<br>' ."
". '<strong>Assunto: </strong>'. $_POST['assuntoRemetente'] ."
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

if(!$mail->Send()) {
$mensagemRetorno = 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
} else {
print "<meta http-equiv='refresh' content='0;URL=obrigado.html'>";
}
}

?>