<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "DocumentDAO.php");

class DocumentDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;

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

    public function getAuthorsByDocumentId($pIdDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->getAuthorsByDocumentId($pIdDocument);
    }
    public function getPublisherByDocumentId($pIdDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->getPublisherByDocumentId($pIdDocument);
    }
    public function getTopDocuments($pType, $pCountTop)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->getTopDocuments($pType, $pCountTop);
    }

    public function searchDocumentByFilter($pType, $pTitle, $pCategory)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->searchDocumentByFilter($pType, $pTitle, $pCategory);
    }

    public function stateReservedDocument($pIdDocument)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->stateReservedDocument($pIdDocument);
    }

    public function searchByCode($pCode, $pType)
    {
        $documentDAO = DocumentDAO::getDocumentDAO($this->connection);
        return $documentDAO->searchByCode($pCode, $pType);
    }
}