<?php
require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Penalty.php");

/**
 * Represents the DAO of the entity "Penalty"
 */

class PenaltyDAO implements DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $penaltyDAO;

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
     * 
     */
    public function create($pPenalty)
    {
        $sql = "INSERT INTO PENALTY VALUES('" . $pPenalty->getId() . "','" . $pPenalty->getDateStart() . "','" . $pPenalty->getDateEnd() . "','" . $pPenalty->getValue() . "','" . $pPenalty->getStatus() . "','" . $pPenalty->getUserId() . "','" . $pPenalty->getBookingId() . "')";
        pg_query($this->connection, $sql);
    }
    /**
     * 
     */
    public function update($pElement)
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
    }

    public function delete($pCode)
    {
    }
    /**
     * Lista de todos los publicadores que hay en el sistema
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM PENALTY";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Penalty();

            $info->setId($row['id']);
            $info->setDateStart($row['dateStart']);
            $info->setDateEnd($row['dateEnd']);
            $info->setValue($row['value']);
            $info->setStatus($row['status']);
            $info->setBookingId($row['bookingId']);

            $data[] = $info;
        }
        return $data;
    }
    public function search($pCode)
    {
        $sql = "SELECT * FROM PENALTY WHERE  penalty_id = " . $pCode;
        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $penaltySearch = new Penalty();

            $penaltySearch->setId($row->penalty_id);
            $penaltySearch->setDateStart($row->date_start);
            $penaltySearch->setDateEnd($row->date_end);
            $penaltySearch->setValue($row->value);
            $penaltySearch->setStatus($row->status);
        } else {
            return null;
        }
        return $penaltySearch;
    }

    public function payPenalty($pCodeBooking, $pValue)
    {
        $sql = "SELECT penalty_id FROM PENALTY_BOOKING WHERE booking_id= " . $pCodeBooking;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        $idPenalty = $row->penalty_id;

        $sql = "UPDATE PENALTY SET date_end=NOW(), value=" . $pValue . " ,status='Paid' WHERE penalty_id = " . $idPenalty;
        pg_query($this->connection, $sql);
    }

    public function payPenaltyByPAYU($pIdPenalty, $pValue)
    {
        $sql = "UPDATE PENALTY SET date_end=NOW(), value=" . $pValue . " ,status='Paid' WHERE penalty_id = " . $pIdPenalty;
        pg_query($this->connection, $sql);

        $sql = "SELECT booking_id FROM PENALTY_BOOKING WHERE penalty_id= " . $pIdPenalty;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        return $row->booking_id;
    }

    public function bookingIsPenalty($pIdBooking)
    {
        $sql = "SELECT penalty_id FROM PENALTY_BOOKING WHERE booking_id= " . $pIdBooking;
        $rta = pg_query($this->connection, $sql);
        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $idPenalty = $row->penalty_id;
            return $idPenalty;
        } else {
            return null;
        }
    }

    public static function getPenaltyDAO($connection)
    {
        if (self::$penaltyDAO == null) {
            self::$penaltyDAO = new PenaltyDAO($connection);
        }
        return self::$penaltyDAO;
    }
}