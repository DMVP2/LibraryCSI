<?php


include_once('../../Routes.php');


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
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];



$nuevoUser = new User();

$nuevoUser->setId($numberDocument);
$nuevoUser->setIdentificationType($typeDocument);
$nuevoUser->setName($name);
$nuevoUser->setLastName($lastName);
$nuevoUser->setMail($mail);
$nuevoUser->setPhone($phone);
$nuevoUser->setPassword(md5($password1));
$nuevoUser->setRole(5);
$nuevoUser->setStatus("Active");

$userDriving->createUser($nuevoUser);

$sendMail = new MailSend();
$sendMail->prepareMail($mail, "ASUNTO PRUEBA - Register", "Desde register, Se ha registrado correctamente");
$rta = $sendMail->sendMail();


echo json_encode(array('success' => $rta));