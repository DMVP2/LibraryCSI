<?php


include_once('../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_BUSINESS . 'MailSend.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

$mail = $_POST['mail'];

$typeDocument = $_POST['typeDocument'];
$numberDocument = $_POST['numberDocument'];

$user = new User();

$passwordDefault = $user->createPassword();
$pass = md5($passwordDefault);

$user->setId($numberDocument);
//$user->setIdentificationType($typeDocument);
//$user->setMail($mail);
$user->setPassword($pass);
$user->setStatus("Inactive");

$userDriving->changePassword($user);

$sendMail = new MailSend();
$sendMail->prepareMail($mail, "ASUNTO PRUEBA - Recovey", "Desde recovery se restablecio su contraseña. Contraseña nueva: " . $passwordDefault);
$rta = $sendMail->sendMail();


echo json_encode(array('success' => $rta));