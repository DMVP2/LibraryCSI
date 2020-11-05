<?php

require_once "DAO.php";

/**
 * Represents the DAO of the entity ""
 */

class Name extends DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $ DAO;

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */
    private function _construct($connection)
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
    public function create($ )
    {
        $sql = "INSERT INTO ";
		mysqli_query($this->conexion, $sql);
    }

    /**
     * 
     */
    public function update($ )
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
}