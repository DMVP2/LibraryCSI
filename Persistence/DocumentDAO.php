<?php

require_once 'DAO.php';

include_once("../Business/Entities/Document.php");



/**
 * Represents the DAO of the entity "Document"
 */

class DocumentDAO implements DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $documentDAO;

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
    public function create($pDocument)
    {
        $sql = "INSERT INTO DOCUMENT VALUES(";
        pg_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function update($pElement)
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
    }

    public function search($pCode)
    {
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM DOCUMENT";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Document();

            $info->setId($row['document_id']);
            $info->setCode($row['code']);
            $info->setTitle($row['title']);
            $info->setState($row['state']);
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType(['type']);



            //FIX
            $info->setCity($row['new_data']);
            $info->setCountry($row['new_data']);
            $info->setAuthors($row['operation']);

            $data[] = $info;
        }

        return $data;
    }

    public function delete($pCode)
    {
    }

    public static function getDocumentDAO($connection)
    {
        if (self::$documentDAO == null) {
            self::$documentDAO = new DocumentDAO($connection);
        }

        return self::$documentDAO;
    }
}