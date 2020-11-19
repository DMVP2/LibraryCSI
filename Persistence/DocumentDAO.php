<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Document.php");



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

        $sql = "SELECT * FROM DOCUMENT WHERE document_id=" . $pCode;
        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $documentSearch = new Document();

            $documentSearch->setId($row->document_id);
            $documentSearch->setCode($row->code);
            $documentSearch->setTitle($row->title);
            $documentSearch->setState($row->date);
            $documentSearch->setCongress($row->congress);
            $documentSearch->setCategory($row->category);
            $documentSearch->setLanguage($row->language);
            $documentSearch->setNumOfPages($row->num_pages);
            $documentSearch->setDateOfPublication($row->date);
            $documentSearch->setEditorial($row->editorial);
            $documentSearch->setType($row->type);
            $documentSearch->setStatus($row->status);
        } else {
            return null;
        }

        return $documentSearch;
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM DOCUMENT ORDER BY status ASC";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Document();

            $info->setId($row['document_id']);
            $info->setCode($row['code']);
            $info->setTitle($row['title']);
            $info->setState($row['date']);
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);

            $data[] = $info;
        }

        return $data;
    }

    public function getTitleDocumentById($pIdDocument)
    {
        $sql = "SELECT title FROM DOCUMENT WHERE document_id= " . $pIdDocument;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        return $row->title;
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