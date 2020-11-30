<?php

include_once('../../../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

$userSession = UserSession::getUserSession();
$userSession->verifySession();

$us = $userSession->getCurrentUser();

$usSesion = $userDriving->searchUserById($us->getUserId());


$bookingDriving = new BookingDriving($connection);
$idDoc = $_REQUEST['idDocument'];
$penaltyInfo = $bookingDriving->getPenaltyInfoByDocumentId($idDoc);
$bookingId = $penaltyInfo[0];
$mail=  $usSesion->getMail();//$penaltyInfo[1];

// Cálculos
$booking = $bookingDriving->search($bookingId);
$fecha1 = new DateTime($booking->getDateOfCollection());
$fecha2 = new DateTime();
$diff = $fecha1->diff($fecha2);
$daysR = $diff->days - 1;
$valueFined = $daysR * $bookingDriving->getValueFined();


//Config
// $url = 'https://checkout.payulatam.com/ppp-web-gateway-payu/'; // Producción
$url = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/'; // Sandbox

$ApiKey = '4Vj8eK4rloUd272L48hsrarnUA';
$merchantId = '508029';
$accountId = '512321';
$description = 'Multa por entrega tardía de documento'; //Descripción del pago
$referenceCode = $bookingId; // Referencia Unica del pedido
$amount = $valueFined; //Es el mo nto total de la transacción.
$tax = '0'; // Es el valor del IVA de la transacción, si se envía el IVA nulo el sistema aplicará el 19% automáticamente. En caso de no tener IVA debe enviarse en 0.
$taxReturnBase = '0'; // Es el valor base sobre el cual se calcula el IVA. En caso de que no tenga IVA debe enviarse en 0.
$currency = 'COP'; // Moneda
$test = 1; // Variable para poder utilizar tarjetas de crédito de pruebas, los valores pueden ser 1 ó 0.
$buyerEmail = $mail; // Respuesta por Payu al comprador
$confirmacionEmail = $mail; // Confirmación email

$responseUrl = "http:/localhost" . ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php'; // URL de respuesta,

$confirmationUrl = "http:/localhost" . ROOT_DIRECTORY . ROUTE_PROCEDURES . 'confirmPayPenalty.php'; // URL de confirmación

//PayU
$firma = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
$firmaMd5 = md5($firma);

?>

<html>

<head></head>

<body>
    <form id="formPayU" method="post" action="<?php echo $url; ?>">
        <input type="hidden" name="merchantId" value="<?php echo $merchantId; ?>"><br>
        <input type="hidden" name="accountId" value="<?php echo $accountId; ?>"><br>
        <input type="hidden" name="description" value="<?php echo $description; ?>"><br>
        <input type="hidden" name="referenceCode" value="<?php echo $referenceCode; ?>"><br>
        <input type="hidden" name="amount" value="<?php echo $amount; ?>"><br>
        <input type="hidden" name="tax" value="<?php echo $tax; ?>"><br>
        <input type="hidden" name="taxReturnBase" value="<?php echo $taxReturnBase; ?>"><br>
        <input type="hidden" name="currency" value="<?php echo $currency; ?>"><br>
        <input type="hidden" name="signature" value="<?php echo $firmaMd5; ?>"><br>
        <input type="hidden" name="test" value="<?php echo $test; ?>"><br>
        <input type="hidden" name="buyerEmail" value="<?php echo $buyerEmail; ?>"><br>
        <input type="hidden" name="responseUrl" value="<?php echo $responseUrl; ?>"><br>
        <input type="hidden" name="confirmationUrl" value="<?php echo $confirmationUrl; ?>"><br>
    </form>
</body>
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/jquery.3.2.1.min.js' ?>" type="text/javascript">
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#formPayU').submit();
});
</script>

</html>