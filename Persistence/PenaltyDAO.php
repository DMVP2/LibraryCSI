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
        mysqli_set_charset($this->connection, "utf8");
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
        mysqli_query($this->connection, $sql);
    }
    /**
     * 
     */
    public function update()
    {
        $sql = "UPDATE - SET";
        mysqli_query($this->connection, $sql);
    }
    /**
     * Lista de todos los publicadores que hay en el sistema
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM PUBLISHER";

        if (!$result = mysqli_query($this->connection, $sql)) die();

        $data = array();

        while ($row = mysqli_fetch_array($result)) {

            $info = new Publisher();

            $info->setId($row['id']);
            $info->setDateStart($row['dateStart']);
            $info->setDateEnd($row['dateEnd']);
            $info->setValue($row['value']);
            $info->setStatus($row['status']);
            $info->setUserId($row['userId']);
            $info->setBookingId($row['bookingId']);

            $sql = "SELECT name FROM ROL, USER_ROL where USER_ROL.document = " . $row['document'];
            $nameRol = mysqli_fetch_array($result)[0];

            $info->setRole($nameRol);

            $data[] = $info;
        }
        return $data;
    }
    public static function getPublisherDAO($connection)
    {
        if (self::$publisherDAO == null) {
            self::$publisherDAO = new PublisherDAO($connection);
        }
        return self::$publisherDAO;
    }
}