<?php

require_once 'DAO.php';

include_once("../Business/Entities/Audit.php");



/**
 * Represents the DAO of the entity "Audit"
 */

class AuditDAO extends DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $auditDAO;

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
    public function create($ )
    {
        $sql = "INSERT INTO ";
		mysqli_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function update($ )
    {
        $sql = "UPDATE - SET";
		mysqli_query($this->connection, $sql);
    }

    /**
	 * 
	 *
	 * @return -[]
	 */
	public function list()
	{
		$sql = "SELECT * FROM ";

		if (!$result = mysqli_query($this->connection, $sql)) die();

		$data = array();

		while ($row = mysqli_fetch_array($result)) {

			$info = new Usuario();

            
			$data[] = $info;
		}

		return $data;
    }
    
    public static function getAuditDAO($connection)
	{
		if (self::$auditDAO == null) {
			self::$auditDAO = new AuditDAO($connection);
		}

		return self::$auditDAO;
	}
}