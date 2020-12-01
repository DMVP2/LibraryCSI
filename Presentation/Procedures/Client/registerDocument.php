<?php


include_once('../../../routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$usSesion = $userSession->getCurrentUser();


if ($usSesion != null) {
    $idUser = $usSesion->getUserId();
}

$documentDriving = new DocumentDriving($connection);

//if (!isset($_POST['typePublisher'])) {
$title = $_POST['title'];
$code = $_POST['code'];
$date = $_POST['date'];
$editorial = $_POST['editorial'];
$lenguage = $_POST['lenguage'];
$num_pages = $_POST['num_pages'];
$category = $_POST['category'];
$typeDocument = $_POST['type'];
//$image = $_POST['image'];
//$pdf = $_POST['pdf'];
$city_id = $_POST['city_id'];
$author_id = $_POST['author_id'];
$description = $_POST['description'];



$nuevoDoc = new Document();

$nuevoDoc->setId('DEFAULT');
$nuevoDoc->setCode($code);
$nuevoDoc->setTitle($title);
$nuevoDoc->setDateOfPublication($date);
$nuevoDoc->setEditorial($editorial);
$nuevoDoc->setLanguage($lenguage);
$nuevoDoc->setNumOfPages($num_pages);
$nuevoDoc->setType($typeDocument);
$nuevoDoc->setCongress("");
$nuevoDoc->setCategory($category);
$nuevoDoc->setStatus("Active");
$nuevoDoc->setImage("");
$nuevoDoc->setDescription("Active");


$documentDriving->createDocument($nuevoDoc);
$documentDriving->completeCreateDocument($idUser, $nuevoDoc, $author_id);

echo json_encode(array('success' => $rta));
