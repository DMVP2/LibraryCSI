<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "AuditDAO.php");

class AuditDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;
    private static $auditDriving;

    //----------------------------------
    // Builder
    //----------------------------------

    public function __construct($pConnection)
    {
        $this->connection = $pConnection;
    }

    //---------------------------------
    // Methods
    //---------------------------------


    public function listAudit()
    {
        $auditDAO = AuditDAO::getAuditDAO($this->connection);
        return $auditDAO->list();
    }
}