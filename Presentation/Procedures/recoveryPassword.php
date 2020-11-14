<?php


include_once('../../Routes.php');


//include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUSuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS . 'MailSend.php');



$c = Connection::getInstance();
//$conexion = $c->connectBD();

//$manejoEstudiante = new ManejoEstudiante($conexion);
//$manejoUsuario = new ManejoUsuario($conexion);

$mail = $_POST['mail'];

$typeDocument = $_POST['typeDocument'];
$numberDocument = $_POST['numberDocument'];

$nuevoUser = new User();

$passwordDefault = $nuevoUser->createPassword();
$pass = md5($passwordDefault);

$nuevoUser->setId($numberDocument);
$nuevoUser->setIdentificationType($typeDocument);
$nuevoUser->setMail($mail);
$nuevoUser->setPassword(md5($pass));
$nuevoUser->setStatus("Inactive");


//$manejoEstudiante->  actualizar contraseña usuario


$sendMail = new MailSend();
$sendMail->prepareMail($mail, "ASUNTO PRUEBA - Recovey", "Desde recovery se restablecio su contraseña. Contraseña nueva: " . $passwordDefault);
$rta = $sendMail->sendMail();


echo json_encode(array('success' => $rta));