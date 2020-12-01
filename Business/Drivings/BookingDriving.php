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

    public function getUserIdBooking($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getUserIdBooking($pIdDocument);
    }
    public function getRenovationsBookingByDocId($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getRenovationsBookingByDocId($pIdDocument);
    }
    public function getUserIdPenaltyBooking($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getUserIdPenaltyBooking($pIdDocument);
    }
    public function getPenaltyInfoByDocumentId($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getPenaltyInfoByDocumentId($pIdDocument);
    }
    public function queueTurn($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->queueTurn($pIdDocument);
    }
    public function joinQueue($pDocumentId, $userId, $numQueue)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->joinQueue($pDocumentId, $userId, $numQueue);
    }
    public function getCountBookingsByUserId($pUserId)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getCountBookingsByUserId($pUserId);
    }
    public function getCountPenaltysByUserId($pUserId)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getCountPenaltysByUserId($pUserId);
    }
    public function getRolNameByUserId($pUserId)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getRolNameByUserId($pUserId);
    }
    public function renovateBooking($pIdDocument, $pDiasRenovacion)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->renovateBooking($pIdDocument, $pDiasRenovacion);
    }
    public function getNameBookingByDocument($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getNameBookingByDocument($pIdDocument);
    }
    public function searchBookingStateByDocumentId($pIdDocument)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->searchBookingStateByDocumentId($pIdDocument);
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

    public function getReportBookingsPerYear($pYear)
    {
        $bookingDAO = BookingDAO::getBookingDAO($this->connection);
        return $bookingDAO->getReportBookingsPerYear($pYear);
    }
}