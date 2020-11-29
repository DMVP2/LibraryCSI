<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Booking.php");

/**
 * Represents the DAO of the entity "Booking"
 */
class BookingDAO implements DAO
{
    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $bookingDAO;

    private static $valueFinedPerDay = 2500;

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */
    private function __construct($connection)
    {
        $this->connection = $connection;
        pg_set_client_encoding($this->connection, "utf8");
    }

    //----------------------------------
    // Methods
    //----------------------------------

    /**
     * Método para crear una reserva 
     */
    public function create($pBooking)
    {
        $sql = "INSERT INTO BOOKING VALUES(null,'" . $pBooking->getIdDocument() . "','" . $pBooking->getIdUser() . "', '" . $pBooking->getBookingStatus() . "','" . $pBooking->getBookingDate() . "','" . $pBooking->getDateOfCollection() . "','" . $pBooking->getDeliveryDate() . "')";
        pg_query($this->connection, $sql);
    }

    public function search($pIdBooking)
    {
        $sql = "SELECT 
                    BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status
                FROM 
                    BOOKING
                WHERE 
                    booking_id = " . $pIdBooking;

        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $bookingSearch = new Booking();

            $bookingSearch->setId($row->booking_id);
            $bookingSearch->setBookingStatus($row->status);
            $bookingSearch->setBookingDate($row->date_start);
            $bookingSearch->setDateOfCollection($row->date_end);
            $bookingSearch->setDeliveryDate($row->date_delivery);
            $bookingSearch->setRenovations($row->renovations);
        } else {
            return null;
        }

        return $bookingSearch;
    }

    /**
     * No se realizarán actuliazaciones de la reserva
     */
    public function update($pBooking)
    {
    }

    /**
     * Retorna una lista de todas las reservas del sistema
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM BOOKING";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['id']);
            $info->setIdDocument($row['idDocument']);
            $info->setIdUser($row['idUser']);
            $info->setBookingStatus($row['bookingStatus']);
            $info->setBookingDate($row['bookingDate']);
            $info->setDateOfCollection($row['dateOfCollection']);
            $info->setDeliveryDate($row['deliveryDate']);
            $info->setRenovations($row['renovations']);

            $data[] = $info;
        }
        return $data;
    }

    public function delete($pCode)
    {
    }

    public function searchBookingByUserId($pUserId)
    {

        $sql = "        SELECT 
                            BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                        FROM 
                            BOOKING, BOOKING_USERS, DOCUMENT_BOOKING, DOCUMENT 
                        WHERE
                            BOOKING.booking_id = BOOKING_USERS.booking_id AND 
                            BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND 
                            DOCUMENT_BOOKING.document_id = DOCUMENT.document_id AND 
                            BOOKING_USERS.user_id = " . $pUserId . "
                            ORDER BY BOOKING.booking_id DESC";

        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['booking_id']);
            $info->setBookingDate($row['date_start']);
            $info->setDeliveryDate($row['date_delivery']);
            $info->setDateOfCollection($row['date_end']);
            $info->setBookingStatus($row['status']);
            $info->setIdDocument($row['document_id']);
            $info->setRenovations($row['renovations']);
            $info->setIdUser($pUserId);

            $data[] = $info;
        }
        return $data;
    }

    public function searchBookingActivesByUserId($pUserId)
    {

        if ($pUserId == "") {
            return -1;
        }

        $sql = "        SELECT 
                            BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                        FROM 
                            BOOKING, BOOKING_USERS, DOCUMENT_BOOKING, DOCUMENT 
                        WHERE
                            BOOKING.booking_id = BOOKING_USERS.booking_id AND BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND DOCUMENT_BOOKING.document_id = DOCUMENT.document_id AND BOOKING.status != 'Completed' AND BOOKING.status != 'Canceled'  AND BOOKING_USERS.user_id = " . $pUserId;


        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['booking_id']);
            $info->setBookingDate($row['date_start']);
            $info->setDeliveryDate($row['date_delivery']);
            $info->setDateOfCollection($row['date_end']);
            $info->setBookingStatus($row['status']);
            $info->setIdDocument($row['document_id']);
            $info->setRenovations($row['renovations']);
            $info->setIdUser($pUserId);

            $data[] = $info;
        }
        return $data;
    }

    public function getNameBookingByDocument($pIdDocument)
    {
        $sql = "SELECT 
                    name, last_name 
                FROM
                    BOOKING,BOOKING_USERS,USERS 
                WHERE
                    USERS.user_id = BOOKING_USERS.user_id AND 
                    BOOKING_USERS.booking_id = BOOKING.booking_id AND 
                    BOOKING.booking_id = " . $pIdDocument;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        $name = $row->name . " " . $row->last_name;
        return $name;
    }



    public function updateStatusBooking($pActualStatus, $pIdBooking)
    {

        if (strcasecmp($pActualStatus, 'Reserved') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        date_delivery=NOW(), status='Retired' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        } else if (strcasecmp($pActualStatus, 'Retired') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        date_end=NOW(), status='Completed' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        } else if (strcasecmp($pActualStatus, 'Fined') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        status='Completed' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        }


        pg_query($this->connection, $sql);
    }

    public function reserveDocument($pUserId, $pDocumentId)
    {
        $sql = "INSERT INTO BOOKING VALUES( DEFAULT,NOW(), NOW() + interval '3 day', NOW(),0,'Reserved')";
        $reserva = pg_query($this->connection, $sql);
        if($reserva){
            $sql = "SELECT booking_id FROM BOOKING ORDER BY booking_id DESC LIMIT 1";
            $rta = pg_query($this->connection, $sql);
            $row = pg_fetch_object($rta);
            $idBooking = $row->booking_id;    
            $sql = "INSERT INTO BOOKING_USERS VALUES(" . $idBooking . ", " . $pUserId . ");"; 
            $sql .= "INSERT INTO DOCUMENT_BOOKING VALUES(" . $pDocumentId . ", " . $idBooking . ");";
            pg_query($this->connection, $sql);
        }
    }

    public function serachBookingFined($pDocumentId)
    {
        $sql = "SELECT 
                    BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                FROM 
                    BOOKING, DOCUMENT_BOOKING 
                WHERE 
                    status='Fined' AND 
                    BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND 
                    document_id=" . $pDocumentId;

        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $bookingSearch = new Booking();

            $bookingSearch->setId($row->document_id);
            $bookingSearch->setIdDocument($pDocumentId);
            $bookingSearch->setBookingStatus($row->status);
            $bookingSearch->setBookingDate($row->date_start);
            $bookingSearch->setDateOfCollection($row->date_end);
            $bookingSearch->setDeliveryDate($row->date_delivery);
            $bookingSearch->setRenovations($row->renovations);
        } else {
            return null;
        }

        return $bookingSearch;
    }

    public function getValueFined()
    {
        return self::$valueFinedPerDay;
    }

    public static function getBookingDAO($connection)
    {
        if (self::$bookingDAO == null) {
            self::$bookingDAO = new BookingDAO($connection);
        }

        return self::$bookingDAO;
    }
}