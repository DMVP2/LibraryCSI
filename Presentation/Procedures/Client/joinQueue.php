<?php
include_once('../../../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Penalty.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$userSession->verifySession();

$usSesion = $userSession->getCurrentUser();
$idUser = $usSesion->getUserId();
$bookingDriving = new BookingDriving($connection);

$idDocument = $_POST['idDocument'];

$turnoCola = $bookingDriving->queueTurn($idDocument);
if(count($turnoCola) > 0){
$numQueue = $turnoCola[0] + 1;
}else{
    $numQueue = 1;
}

$bookingDriving->joinQueue($idDocument, $idUser, $numQueue);
if($bookingDriving = 1){
echo json_encode(array('success' => '1')); 
}
else{
echo json_encode(array('success' => '0')); 

}