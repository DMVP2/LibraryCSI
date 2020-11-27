<?php


include_once('../../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS_LIB . 'MailSend.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

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
$nuevoUser->setRole(2);
$nuevoUser->setStatus("Inactive");


$userDriving->createUser($nuevoUser);

$sendMail = new MailSend();
$sendMail->prepareMail($mail, "ASUNTO PRUEBA - Employee", "Desde owner, Su contraseña es: " . $passwordDefault);
$rta = $sendMail->sendMail();


echo json_encode(array('success' => $rta));