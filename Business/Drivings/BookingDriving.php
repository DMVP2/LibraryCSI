<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "BookingDAO.php");

class BookingDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;

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

    public function search($pIdBooking)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->search($pIdBooking);
    }

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

    public function reserveDocument($pUserId, $pDocumentId, $pStatus)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        $bookingDAO->reserveDocument($pUserId, $pDocumentId, $pStatus);
    }

    public function getValueFined()
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getValueFined();
    }

    public function getReportBookingPerDay()
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getReportBookingPerDay();
    }
}