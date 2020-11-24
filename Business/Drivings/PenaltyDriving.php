<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "PenaltyDAO.php");

class PenaltyDriving
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

    public function createPenalty($pPenalty)
    {
        $penaltyDAO = PenaltyDAO::getPenaltyDAO($this->connection);
        $penaltyDAO->create($pPenalty);
    }

    public function searchPenaltyById($pId)
    {
        $penaltyDAO = PenaltyDAO::getPenaltyDAO($this->connection);
        return $penaltyDAO->search($pId);
    }

    public function payPenalty($pCodeBooking, $pValue)
    {
        $penaltyDAO = PenaltyDAO::getPenaltyDAO($this->connection);
        $penaltyDAO->payPenalty($pCodeBooking, $pValue);
    }

    public function payPenaltyByPAYU($pIdPenalty, $pValue)
    {
        $penaltyDAO = PenaltyDAO::getPenaltyDAO($this->connection);
        return $penaltyDAO->payPenaltyByPAYU($pIdPenalty, $pValue);
    }

    public function bookingIsPenalty($pIdBooking)
    {
        $penaltyDAO = PenaltyDAO::getPenaltyDAO($this->connection);
        return $penaltyDAO->bookingIsPenalty($pIdBooking);
    }
}