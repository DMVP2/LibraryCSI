<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Audit.php");



/**
 * Represents the DAO of the entity "Audit"
 */

class AuditDAO implements DAO
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
    public function create($pAudit)
    {
        $sql = "INSERT INTO AUDIT VALUES(null,'" . $pAudit->getUser() . "','" . $pAudit->getTable() . "', '" . $pAudit->getIp() . "','" . $pAudit->getOperation() . "','" . $pAudit->getDate() . "','" . $pAudit->getOldData() . "', '" . $pAudit->getNewData() . "')";
        pg_query($this->connection, $sql);
    }

    public function search($pCode)
    {
    }

    /**
     * 
     */
    public function update($pAudit)
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
    }

    public function delete($pCode)
    {
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM AUDIT";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Audit();

            $info->setAuditId($row['audit_id']);
            $info->setTable($row['table_name']);
            $info->setIp($row['ip']);
            $info->setOperation($row['operation']);
            $info->setDate($row['date']);
            $info->setOldData($row['old_data']);
            $info->setNewData($row['new_data']);

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