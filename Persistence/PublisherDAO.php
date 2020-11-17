<?php
require_once 'DAO.php';

include_once("../Business/Entities/Publisher.php");
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
        mysqli_set_charset($this->connection, "utf8");
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
        mysqli_query($this->connection, $sql);

        $sql = "INSERT INTO USER VALUES('" . $pUser->getId() . "','" . $pUser->getTypeDocument() . "','" . $pUser->getName() . "','" . $pUser->getLastName() . "','" . $pUser->getMail() . "','" . $pUser->getPhone() . "','" . $pUser->getPassword() . "','" . $pUser->getStatus() . "')";
        mysqli_query($this->connection, $sql); //Se debe especificar como se crea el usuario al crear el publisher, si lo hacemos en otro método

        $sql = "INSERT INTO USER_ROL VALUES('" . $pUser->getId() . "'," . $pUser->getRole() . " )";
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

            $info = new User();

            $info->setDocument($row['document']);
            $info->setTypeDocument($row['typeDocument']);
            $info->setBusinessName($row['businessName']);
            $info->setEmail($row['mail']);
            $info->setPhone($row['phone']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);

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