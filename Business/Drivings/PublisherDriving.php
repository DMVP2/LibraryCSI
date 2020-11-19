<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "PublisherDAO.php");

class PublisherDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------
    private $connection;
    private static $publisherDriving;
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
    public function createPublisher($pPublisher)
    {
        $publisherDAO = PublisherDAO::getPublisherDAO($this->connection);
        $publisherDAO->create($pPublisher);
    }

    public function searchPublisherById($pId)
    {
        $publisherDAO = PublisherDAO::getPublisherDAO($this->connection);
        return $publisherDAO->search($pId);
    }
}