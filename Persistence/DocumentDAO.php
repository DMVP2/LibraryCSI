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
            $documentSearch->setCongress($row->congress);
            $documentSearch->setCategory($row->category);
            $documentSearch->setLanguage($row->language);
            $documentSearch->setNumOfPages($row->num_pages);
            $documentSearch->setDateOfPublication($row->date);
            $documentSearch->setEditorial($row->editorial);
            $documentSearch->setType($row->type);
            $documentSearch->setStatus($row->status);
            $documentSearch->setImage($row->image);
        } else {
            return null;
        }

        return $documentSearch;
    }

    public function searchByCode($pCode, $pType)
    {
        $sql = "SELECT * FROM DOCUMENT WHERE UPPER(code)=UPPER('" . $pCode . "') AND type='" . $pType . "'";

        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) > 0) {
            $data = array();

            while ($row = pg_fetch_array($result)) {

                $info = new Document();

                $info->setId($row['document_id']);
                $info->setCode($row['code']);
                $info->setTitle($row['title']);
                $info->setCongress($row['congress']);
                $info->setCategory($row['category']);
                $info->setLanguage($row['language']);
                $info->setNumOfPages($row['num_pages']);
                $info->setDateOfPublication($row['date']);
                $info->setEditorial($row['editorial']);
                $info->setType($row['type']);
                $info->setStatus($row['status']);
                $info->setImage($row['image']);

                $data[] = $info;
            }

            return $data;
        } else {
            return null;
        }
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
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);
            $info->setImage($row['image']);

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

    public function stateReservedDocument($pIdDocument)
    {
        $sql = "SELECT
                    * 
                FROM 
                    BOOKING, DOCUMENT_BOOKING 
                WHERE
                    BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND 
                    DOCUMENT_BOOKING.document_id = " . $pIdDocument . " AND 
                    status = 'Reserved' OR 
                    status = 'Retired' OR 
                    status = 'Fined'";

        $rta = pg_query($this->connection, $sql);
        if (pg_num_rows($rta) > 0) {
            return true;
        }

        return false;
    }

    public function getTopDocuments($pType, $pCountTop)
    {
        if (strcasecmp($pType, 'Fisico') == 0) {
            $sql = "SELECT 
                        DOCUMENT_BOOKING.document_id,code,title, congress, category, language, num_pages, date, editorial, type, status, image, count(DOCUMENT_BOOKING.document_id) as nBookings
                    FROM 
                        DOCUMENT_BOOKING, DOCUMENT 
                    WHERE 
                        DOCUMENT_BOOKING.document_id = DOCUMENT.document_id AND type='Fisico' 
                    GROUP BY(DOCUMENT_BOOKING.document_id,code,title, congress, category, language, num_pages, date, editorial, type, status, image) 
                    ORDER BY nBookings DESC LIMIT " . $pCountTop;
        } else {
            $sql = "SELECT 
                        DOCUMENT.document_id,code,title, congress, category, language, num_pages, date, editorial, type, status, image, count(DOWNLOAD.document_id) as nBookings
                    FROM 
                        DOCUMENT, DOWNLOAD 
                    WHERE 
                        DOWNLOAD.document_id = DOCUMENT.document_id AND type='Virtual' 
                    GROUP BY(DOCUMENT.document_id,code,title, congress, category, language, num_pages, date, editorial, type, status, image) 
                    ORDER BY nBookings DESC LIMIT " . $pCountTop;
        }

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Document();

            $info->setId($row['document_id']);
            $info->setCode($row['code']);
            $info->setTitle($row['title']);
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);
            $info->setImage($row['image']);

            $data[] = $info;
        }

        if (count($data) < $pCountTop) {
            $data = array_merge($data, $this->completeDocuments($data, $pCountTop, $pType));
        }

        return $data;
    }

    public function completeDocuments($pDocumentSelect, $pCount, $pType)
    {
        $num = $pCount - (count($pDocumentSelect));

        $sql = "SELECT * FROM DOCUMENT WHERE type='" . $pType . "'";

        foreach ($pDocumentSelect as $document) {
            $sql = $sql . " AND document_id != " . $document->getDocumentId();
        }
        $sql = $sql . " LIMIT " . $num;

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Document();

            $info->setId($row['document_id']);
            $info->setCode($row['code']);
            $info->setTitle($row['title']);
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);
            $info->setImage($row['image']);

            $data[] = $info;
        }

        return $data;
    }

    public function searchDocumentByFilter($pType, $pTitle, $pCategory)
    {
        if (!empty($pTitle) and !empty($pCategory)) {
            //Search by title and category
            $sql = "SELECT * FROM DOCUMENT WHERE UPPER(title) LIKE UPPER('%" . $pTitle . "%')";
            $sql = $sql . " AND category = '" . $pCategory . "'";
            $sql = $sql . " AND type = '" . $pType . "'";
        } else if (!empty($pTitle)) {
            //Search by title
            $sql = "SELECT * FROM DOCUMENT WHERE UPPER(title) LIKE UPPER('%" . $pTitle . "%')";
            $sql = $sql . " AND type = '" . $pType . "'";
        } else if (!empty($pCategory)) {
            //Search by category
            $sql = "SELECT * FROM DOCUMENT WHERE category = '" . $pCategory . "'";
            $sql = $sql . " AND type = '" . $pType . "'";
        }


        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Document();

            $info->setId($row['document_id']);
            $info->setCode($row['code']);
            $info->setTitle($row['title']);
            $info->setCongress($row['congress']);
            $info->setCategory($row['category']);
            $info->setLanguage($row['language']);
            $info->setNumOfPages($row['num_pages']);
            $info->setDateOfPublication($row['date']);
            $info->setEditorial($row['editorial']);
            $info->setType($row['type']);
            $info->setStatus($row['status']);
            $info->setImage($row['image']);

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