<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "DocumentDAO.php");

class DocumentDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;
    private static $documentDriving;

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

    public function getDocument($pIdDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->search($pIdDocument);
    }


    public function createDocument($pDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        $documentDAO->create($pDocument);
    }

    public function listDocuments()
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->list();
    }

    public function getTitleDocumentById($pIdDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->getTitleDocumentById($pIdDocument);
    }
}