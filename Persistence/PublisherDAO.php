<?php
require_once 'DAO.php';

include_once("../Business/Entities/Publisher.php");
/**
 * Represents the DAO of the entity "Publisher"
 */

class PublisherDAO extends DAO
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
    public function create($pPublisher)
    {
        $sql = "INSERT INTO PUBLISHER VALUES('" . $pPublisher->getDocument() . "','" . $pPublisher->getTypeDocument() . "','" . $pPublisher->getBusinessName() . "','" . $pPublisher->getMail() . "','" . $pPublisher->getPhone() . "','" . $pPublisher->getType() . "','" . $pPublisher->getStatus() . "')";
        pg_query($this->connection, $sql);

        $sql = "INSERT INTO USER VALUES('" . $pPublisher->getId() . "','" . $pPublisher->getTypeDocument() . "','" . $pPublisher->getName() . "','" . $pPublisher->getLastName() . "','" . $pPublisher->getMail() . "','" . $pPublisher->getPhone() . "','" . $pPublisher->getPassword() . "','" . $pPublisher->getStatus() . "')";
        pg_query($this->connection, $sql); //Se debe especificar como se crea el usuario al crear el publisher, si lo hacemos en otro método

        $sql = "INSERT INTO USER_ROL VALUES('" . $pPublisher->getId() . "'," . $pPublisher->getRole() . " )";
        pg_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function update(){}

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