<?php
require_once 'DAO.php';

include_once("../Business/Entities/Penalty.php");

/**
 * Represents the DAO of the entity "Penalty"
 */

class PenaltyDAO extends DAO
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
    private function _construct($connection)
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
    public function update()
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
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
            $info->setUserId($row['userId']);
            $info->setBookingId($row['bookingId']);
            
            $data[] = $info;
        }
        return $data;
    }
    
    public static function getPenaltyDAO($connection)
    {
        if (self::$penaltyDAO == null) {
            self::$penaltyDAO = new PublisherDAO($connection);
        }
        return self::$penaltyDAO;
    }
}