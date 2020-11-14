<?php


include_once('../../../Routes.php');


//include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUSuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS . 'MailSend.php');



$c = Connection::getInstance();
//$conexion = $c->connectBD();

//$manejoEstudiante = new ManejoEstudiante($conexion);
//$manejoUsuario = new ManejoUsuario($conexion);

print_r($_POST);

$mail = $_POST['mail'];

$typeDocument = $_POST['typeDocument'];
$numberDocument = $_POST['numberDocument'];
$name = $_POST['name'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];



$nuevoUser = new User();

$passwordDefault = $nuevoUser->createPassword();
$password = md5($passwordDefault);

$nuevoUser->setId($numberDocument);
$nuevoUser->setIdentificationType($typeDocument);
$nuevoUser->setName($name);
$nuevoUser->setLastName($lastName);
$nuevoUser->setMail($mail);
$nuevoUser->setPhone($phone);
$nuevoUser->setPassword($password);
$nuevoUser->setRole("Por Definir");
$nuevoUser->setStatus("Por Definir");


//$manejoEstudiante->crearEstudiante($nuevoEstudiante);


$sendMail = new MailSend();
$sendMail->prepareMail($mail, "ASUNTO PRUEBA", "Su contraseña es: " . $password);
$sendMail->sendMail();


echo json_encode(array('success' => 1));