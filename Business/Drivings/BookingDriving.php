<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "BookingDAO.php");

class BookingDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;
    private static $bookingDriving;

    //----------------------------------
    // Builder
    //----------------------------------

    public function __construct($pConnection)
    {
        $this->connection = $pConnection;
    }

    //---------------------------------
    // Methods
    //---------------------------------

    public function listBookingById($pIdUser)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->searchBookingByUserId($pIdUser);
    }

    public function searchBookingActivesByUserId($pIdUser)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->searchBookingActivesByUserId($pIdUser);
    }

    public function getNameBookingByDocument($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getNameBookingByDocument($pIdDocument);
    }

    public function updateStatusBooking($pActualStatus, $pIdBooking)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        $bookingDAO->updateStatusBooking($pActualStatus, $pIdBooking);
    }

    public function reserveDocument($pUserId, $pDocumentId)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        $bookingDAO->reserveDocument($pUserId, $pDocumentId);
    }
}