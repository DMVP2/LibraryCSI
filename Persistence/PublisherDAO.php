<?php
require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Publisher.php");
/**
 * Represents the DAO of the entity "Publisher"
 */

class PublisherDAO implements DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $publisherDAO;

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
    public function create($pPublisher)
    {
        $sql = "INSERT INTO PUBLISHER VALUES('" . $pPublisher->getDocument() . "','" . $pPublisher->getBusinessName() . "','" . $pPublisher->getTypeDocument() . "','" . $pPublisher->getAttendant() . "','" . $pPublisher->getMail() . "','" . $pPublisher->getPhone() . "','" . $pPublisher->getType() . "','" . $pPublisher->getStatus() . "')";
        pg_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function search($pIdPublisher)
    {
    }

    /**
     * 
     */
    public function update($pElement)
    {
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
        $sql = "SELECT * FROM PUBLISHER";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Publisher();

            $info->setDocument($row['document']);
            $info->setTypeDocument($row['typeDocument']);
            $info->setBusinessName($row['businessName']);
            $info->setEmail($row['mail']);
            $info->setPhone($row['phone']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);

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