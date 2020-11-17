<?php

require_once 'DAO.php';

include_once("../Business/Entities/Booking.php");

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

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */
    private function __construct($connection)
    {
        $this->connection = $connection;
        mysqli_set_charset($this->connection, "utf8");
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
        mysqli_query($this->connection, $sql);
    }

    public function search($pCode)
    {
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

        if (!$result = mysqli_query($this->connection, $sql)) die();

        $data = array();

        while ($row = mysqli_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['id']);
            $info->setIdDocument($row['idDocument']);
            $info->setIdUser($row['idUser']);
            $info->setBookingStatus($row['bookingStatus']);
            $info->setBookingDate($row['bookingDate']);
            $info->setDateOfCollection($row['dateOfCollection']);
            $info->setDeliveryDate($row['deliveryDate']);

            $data[] = $info;
        }
        return $data;
    }

    public function delete($pCode)
    {
    }

    public static function getBookingDAO($connection)
    {
        if (self::$bookingDAO == null) {
            self::$bookingDAO = new BookingDAO($connection);
        }

        return self::$bookingDAO;
    }
}