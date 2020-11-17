<?php

require_once "DAO.php";

/**
 * Represents the DAO of the entity ""
 */

class Name implements DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $elementDAO;

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */
    private function __construct($connection)
    {
        $this->connection = $connection;
        mysqli_set_charset($this->conexion, "utf8");
    }

    //----------------------------------
    // Methods
    //----------------------------------

    /**
     * 
     */
    public function create($pElement)
    {
        $sql = "INSERT INTO ";
        mysqli_query($this->conexion, $sql);
    }

    public function search($pCode)
    {
    }

    /**
     * 
     */
    public function update($pElement)
    {
        $sql = "UPDATE - SET";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM ";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $data = array();

        while ($row = mysqli_fetch_array($result)) {

            $info = new Usuario();


            $data[] = $info;
        }

        return $data;
    }

    public function delete($pCode)
    {
    }
}