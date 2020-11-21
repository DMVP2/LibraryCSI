<?php

include_once('../Routes.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$userSession = UserSession::getUserSession();
$userSession->closeSession();

header("Location: " . ROOT_DIRECTORY . "/index.php");