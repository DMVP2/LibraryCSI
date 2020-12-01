<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "Booking.php");

/**
 * Represents the DAO of the entity "Booking"
 */
class BookingDAO implements DAO
{
    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $bookingDAO;

    private static $valueFinedPerDay = 2500;

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
     * Método para crear una reserva 
     */
    public function create($pBooking)
    {
        $sql = "INSERT INTO BOOKING VALUES(null,'" . $pBooking->getIdDocument() . "','" . $pBooking->getIdUser() . "', '" . $pBooking->getBookingStatus() . "','" . $pBooking->getBookingDate() . "','" . $pBooking->getDateOfCollection() . "','" . $pBooking->getDeliveryDate() . "')";
        pg_query($this->connection, $sql);
    }

    public function search($pIdBooking)
    {
        $sql = "SELECT 
                    BOOKING.booking_id, BOOKING.date_start, BOOKING.date_end, BOOKING.date_delivery, BOOKING.renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                FROM 
                    BOOKING, DOCUMENT_BOOKING 
                WHERE 
                    BOOKING.booking_id =" . $pIdBooking;

        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $bookingSearch = new Booking();

            $bookingSearch->setId($row->booking_id);
            $bookingSearch->setBookingStatus($row->status);
            $bookingSearch->setBookingDate($row->date_start);
            $bookingSearch->setDateOfCollection($row->date_end);
            $bookingSearch->setDeliveryDate($row->date_delivery);
            $bookingSearch->setRenovations($row->renovations);
            $bookingSearch->setIdDocument($row->document_id);
        } else {
            return null;
        }

        return $bookingSearch;
    }

    /**
     * No se realizarán actuliazaciones de la reserva
     */
    public function update($pBooking)
    {
    }

    /**
     * Retorna una lista de todas las reservas del sistema
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM BOOKING";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['id']);
            $info->setIdDocument($row['idDocument']);
            $info->setIdUser($row['idUser']);
            $info->setBookingStatus($row['bookingStatus']);
            $info->setBookingDate($row['bookingDate']);
            $info->setDateOfCollection($row['dateOfCollection']);
            $info->setDeliveryDate($row['deliveryDate']);
            $info->setRenovations($row['renovations']);

            $data[] = $info;
        }
        return $data;
    }

    public function delete($pCode)
    {
    }

    public function searchBookingByUserId($pUserId)
    {

        $sql = "        SELECT 
                            BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                        FROM 
                            BOOKING, BOOKING_USERS, DOCUMENT_BOOKING, DOCUMENT 
                        WHERE
                            BOOKING.booking_id = BOOKING_USERS.booking_id AND 
                            BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND 
                            DOCUMENT_BOOKING.document_id = DOCUMENT.document_id AND 
                            BOOKING_USERS.user_id = " . $pUserId . "
                            ORDER BY BOOKING.booking_id DESC";

        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['booking_id']);
            $info->setBookingDate($row['date_start']);
            $info->setDeliveryDate($row['date_delivery']);
            $info->setDateOfCollection($row['date_end']);
            $info->setBookingStatus($row['status']);
            $info->setIdDocument($row['document_id']);
            $info->setRenovations($row['renovations']);
            $info->setIdUser($pUserId);

            $data[] = $info;
        }
        return $data;
    }
    public function searchBookingStateByDocumentId($pDocumentId)
    {

        $sql = "SELECT
                    status 
                FROM 
                    BOOKING, DOCUMENT_BOOKING
                WHERE 
                    BOOKING.booking_id = DOCUMENT_BOOKING.booking_id
                AND
                    document_id =" . $pDocumentId . ";";

        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();
            $info->setBookingStatus($row['status']);
            $data[] = $info;
        }
        return $data;
    }
    // Retorna el código del usuario que realizó la reserva de x documentoId
    // tan solo lo retorna cuándo el estado de la reserva es 'Reserved' o 'Retired'
    public function getUserIdBooking($pDocumentId)
    {

        $sql = "SELECT
                    user_id 
                FROM 
                    BOOKING, DOCUMENT_BOOKING, BOOKING_USERS
                WHERE 
                    BOOKING.booking_id = DOCUMENT_BOOKING.booking_id
                AND
                    DOCUMENT_BOOKING.booking_id = BOOKING_USERS.booking_id                    
                AND
                    (BOOKING.status = 'Reserved' or BOOKING.status ='Retired') 
                AND
                    document_id =" . $pDocumentId . ";";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = $row['user_id'];
            $data[] = $info;
        }
        return $data;
    }
    // Retorna la cuenta de reservas activas de un usuario
    // tan solo lo retorna cuándo el estado de la reserva es 'Reserved' o 'Retired'
    public function getCountBookingsByUserId($pUserId)
    {

        $sql = "SELECT count(*) 
        FROM
        BOOKING, BOOKING_USERS
        WHERE 
        BOOKING_USERS.user_id = " . $pUserId . " AND
        BOOKING.booking_id = BOOKING_USERS.booking_id   AND
        BOOKING.status = 'Reserved' or BOOKING.status = 'Retired' ";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = $row['count'];
            $data[] = $info;
        }
        return $data;
    }
        // tan solo lo retorna cuándo el estado de la reserva es 'Reserved' o 'Retired'
        public function getRolNameByUserId($pUserId)
        {
    
            $sql = "SELECT 
            rol 
            FROM USERS, USERS_ROL, ROL 
            WHERE USERS.user_id =" . $pUserId . " AND 
            USERS.user_id = USERS_ROL.user_id AND 
            USERS_ROL.rol_id = ROL.rol_id ; ";
    
            if (!$result = pg_query($this->connection, $sql)) die();
    
            $data = array();
    
            while ($row = pg_fetch_array($result)) {
    
                $info = $row['rol'];
                $data[] = $info;
            }
            return $data;
        }
    // Retorna la cuenta de las penalidades activas de un usuario
    // tan solo lo retorna cuándo el estado de 'Pending'
    public function getCountPenaltysByUserId($pUserId)
    {

        $sql = "SELECT count(*) FROM BOOKING, BOOKING_USERS , PENALTY_BOOKING, PENALTY
        WHERE BOOKING_USERS.user_id = " . $pUserId . " AND
        BOOKING.booking_id = BOOKING_USERS.booking_id AND
        BOOKING.booking_id = PENALTY_BOOKING.booking_id AND
        PENALTY_BOOKING.penalty_id = PENALTY.penalty_id  AND
        PENALTY.status = 'Pending' ";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = $row['count'];
            $data[] = $info;
        }
        return $data;
    }
      /*   // Devuelve el número de 
        public function getCountPenaltysByUserId($pUserId)
        {
    
            $sql = "SELECT count(*) FROM BOOKING, BOOKING_USERS , PENALTY_BOOKING, PENALTY
            WHERE BOOKING_USERS.user_id = " . $pUserId . " AND
            BOOKING.booking_id = BOOKING_USERS.booking_id AND
            BOOKING.booking_id = PENALTY_BOOKING.booking_id AND
            PENALTY_BOOKING.penalty_id = PENALTY.penalty_id  AND
            PENALTY.status = 'Pending' ";
    
            if (!$result = pg_query($this->connection, $sql)) die();
    
            $data = array();
    
            while ($row = pg_fetch_array($result)) {
    
                $info = $row['count'];
                $data[] = $info;
            }
            return $data;
        } */
    // Retorna los datos de una multa activas
    // DATOS: booking_id, fecha de finalización dispuesta para la reserva, e-mail del usuario
    // tan solo lo retorna cuándo el estado de 'Pending'
    public function getPenaltyInfoByDocumentId($pDocumentId)
    {

        $sql = "SELECT
        DOCUMENT_BOOKING.booking_id as book
        FROM
        BOOKING, DOCUMENT_BOOKING, PENALTY_BOOKING, PENALTY, BOOKING_USERS, USERS
        WHERE
        DOCUMENT_BOOKING.document_id =" . $pDocumentId . " AND
        BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND
        BOOKING.booking_id = PENALTY_BOOKING.booking_id AND
        BOOKING.booking_id = BOOKING_USERS.booking_id AND
        BOOKING_USERS.user_id = USERS.user_id AND
        PENALTY_BOOKING.penalty_id = PENALTY.penalty_id AND
        PENALTY.status = 'Pending' ;";

        $result = pg_query($this->connection, $sql);

        $data = array();

        while ($row = pg_fetch_array($result)) {
            $info = $row['book'];

            $data[] = $info;
        }
        return $data;
    }
    // ingresar a la cola de reservas
    public function joinQueue($pDocumentId, $userId, $numQueue)
    {
        $sql = "INSERT INTO QUEUE VALUES(DEFAULT, $userId, NOW(), $numQueue);";
        $queueInsert = pg_query($this->connection, $sql);
        if ($queueInsert) {
            $sql = "SELECT DOCUMENT_QUEUE.queue_id 
            FROM
            QUEUE, DOCUMENT_QUEUE
            WHERE  DOCUMENT_QUEUE.document_id = " . $pDocumentId . " AND
            QUEUE.queue_id = DOCUMENT_QUEUE.queue_id
            ORDER BY DOCUMENT_QUEUE.queue_id DESC LIMIT 1";

            $rta = pg_query($this->connection, $sql);
            while ($row = pg_fetch_array($rta)) {
                $info = $row['queue_id'];
                $data[] = $info;
                $sql = "INSERT INTO DOCUMENT_QUEUE VALUES(" . $pDocumentId . ", " . $data[0] . ");";
                pg_query($this->connection, $sql);
            }
            return 1;
        }
        return -1;
    }
    // Genera el último número en la cola (turno)
    public function queueTurn($pDocumentId)
    {

        $sql = "SELECT num_queue
            FROM
            QUEUE, DOCUMENT_QUEUE
            WHERE  DOCUMENT_QUEUE.document_id = " . $pDocumentId . " AND
            QUEUE.queue_id = DOCUMENT_QUEUE.queue_id
            ORDER BY DOCUMENT_QUEUE.queue_id DESC LIMIT 1";

        $result = pg_query($this->connection, $sql);

        $data = array();

        while ($row = pg_fetch_array($result)) {
            $info = $row['num_queue'];
            $data[] = $info;
        }
        return $data;
    }
    // Retorna el código del usuario que realizó la reserva y tiene una MULTA ACTIVA de x documentoId
    // tan solo lo retorna cuándo el estado de la reserva es 'Penalty'
    public function getUserIdPenaltyBooking($pDocumentId)
    {

        $sql = "SELECT
        user_id
        FROM
        BOOKING, BOOKING_USERS, DOCUMENT_BOOKING, PENALTY_BOOKING, PENALTY
        WHERE
        document_id =" . $pDocumentId . " AND
        BOOKING_USERS.booking_id = BOOKING.booking_id
        AND
        DOCUMENT_BOOKING.booking_id = BOOKING.booking_id
        AND
        PENALTY_BOOKING.booking_id = BOOKING.booking_id
        AND
        PENALTY_BOOKING.penalty_id = PENALTY.penalty_id
        AND
        (PENALTY.status = 'Pending' or BOOKING.status = 'Penalty');";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {
            $info = $row['user_id'];
            $data[] = $info;
        }
        return $data;
    }
    public function getDateEndBooking($pDocumentId)
    {

        $sql = "SELECT date_end 
        FROM BOOKING, DOCUMENT_BOOKING 
        WHERE DOCUMENT_BOOKING.document_id =  " . $pDocumentId . " AND 
        BOOKING.booking_id = DOCUMENT_BOOKING.booking_id; ";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {
            $info = $row['date_end'];
            $data[] = $info;
        }
        return $data;
    }
    // Realiza la renovación de una reserva, busca la fecha y el id de la reserva
    // actualiza Booking sumando los X días de la reserva
    public function renovateBooking($pDocumentId, $pDiasRenovacion)
    {
        $sql = "SELECT
        BOOKING.booking_id, renovations
        FROM
        BOOKING, DOCUMENT_BOOKING
        WHERE 
        DOCUMENT_BOOKING.document_id = " . $pDocumentId . " AND
        BOOKING.booking_id = DOCUMENT_BOOKING.booking_id;";

        $result = pg_query($this->connection, $sql);

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = $row['booking_id'];
            $info = $row['renovations'];
            $data[] = $info;


            $renovationsNow = $row['renovations'] + 1;
            $sql = "UPDATE
            BOOKING
            SET
            date_end=NOW()+interval '" . $pDiasRenovacion . " day', renovations= $renovationsNow  
            WHERE
            booking_id =" . $row['booking_id'];

            pg_query($this->connection, $sql);
        }
    }
    public function getRenovationsBookingByDocId($pDocumentId)
    {

        $sql = "SELECT
                    renovations 
                FROM 
                    BOOKING, DOCUMENT_BOOKING, BOOKING_USERS
                WHERE 
                    BOOKING.booking_id = DOCUMENT_BOOKING.booking_id
                AND
                    DOCUMENT_BOOKING.booking_id = BOOKING_USERS.booking_id
                AND
                    document_id =" . $pDocumentId . ";";

        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = $row['renovations'];
            $data[] = $info;
        }
        return $data;
    }
    
    public function searchBookingActivesByUserId($pUserId)
    {

        if ($pUserId == "") {
            return -1;
        }

        $sql = "        SELECT 
                            BOOKING.booking_id, date_start, date_end, date_delivery, renovations, BOOKING.status, DOCUMENT_BOOKING.document_id 
                        FROM 
                            BOOKING, BOOKING_USERS, DOCUMENT_BOOKING, DOCUMENT 
                        WHERE
                            BOOKING.booking_id = BOOKING_USERS.booking_id AND BOOKING.booking_id = DOCUMENT_BOOKING.booking_id AND DOCUMENT_BOOKING.document_id = DOCUMENT.document_id AND BOOKING.status != 'Completed' AND BOOKING.status != 'Canceled'  AND BOOKING_USERS.user_id = " . $pUserId;


        if (!$result = pg_query($this->connection, $sql)) die();

        if (pg_num_rows($result) == 0)
            return -1;

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new Booking();

            $info->setId($row['booking_id']);
            $info->setBookingDate($row['date_start']);
            $info->setDeliveryDate($row['date_delivery']);
            $info->setDateOfCollection($row['date_end']);
            $info->setBookingStatus($row['status']);
            $info->setIdDocument($row['document_id']);
            $info->setRenovations($row['renovations']);
            $info->setIdUser($pUserId);

            $data[] = $info;
        }
        return $data;
    }

    public function getNameBookingByDocument($pIdDocument)
    {
        $sql = "SELECT 
                    name, last_name 
                FROM
                    BOOKING,BOOKING_USERS,USERS 
                WHERE
                    USERS.user_id = BOOKING_USERS.user_id AND 
                    BOOKING_USERS.booking_id = BOOKING.booking_id AND 
                    BOOKING.booking_id = " . $pIdDocument;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        $name = $row->name . " " . $row->last_name;
        return $name;
    }



    public function updateStatusBooking($pActualStatus, $pIdBooking)
    {

        if (strcasecmp($pActualStatus, 'Reserved') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        date_delivery=NOW(), status='Retired' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        } else if (strcasecmp($pActualStatus, 'Retired') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        date_end=NOW(), status='Completed' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        } else if (strcasecmp($pActualStatus, 'Fined') == 0) {
            $sql = "UPDATE
                        BOOKING 
                    SET 
                        status='Completed' 
                    WHERE 
                        booking_id=" . $pIdBooking;
        }


        pg_query($this->connection, $sql);
    }
    public function reserveDocument($pUserId, $pDocumentId, $pStatus)
    {
        if ($pStatus == 'Reserved') {
            $sql = "INSERT INTO BOOKING VALUES(DEFAULT, NOW(), NOW() + interval '3 day',null,0,'" . $pStatus . "')";
            $reserva = pg_query($this->connection, $sql);
            if ($reserva) {
                $sql = "SELECT booking_id FROM BOOKING ORDER BY booking_id DESC LIMIT 1";
                $rta = pg_query($this->connection, $sql);
                $row = pg_fetch_object($rta);
                $idBooking = $row->booking_id;
                $sql = "INSERT INTO BOOKING_USERS VALUES(" . $idBooking . ", " . $pUserId . ");";
                $sql .= "INSERT INTO DOCUMENT_BOOKING VALUES(" . $pDocumentId . ", " . $idBooking . ");";
                pg_query($this->connection, $sql);
            }
        } else {
            $sql = "INSERT INTO BOOKING VALUES(DEFAULT, NOW(), NOW() + interval '3 day', NOW(),0,'" . $pStatus . "')";
            $reserva = pg_query($this->connection, $sql);
            if ($reserva) {
                $sql = "SELECT booking_id FROM BOOKING ORDER BY booking_id DESC LIMIT 1";
                $rta = pg_query($this->connection, $sql);
                $row = pg_fetch_object($rta);
                $idBooking = $row->booking_id;
                $sql = "INSERT INTO BOOKING_USERS VALUES(" . $idBooking . ", " . $pUserId . ");";
                $sql .= "INSERT INTO DOCUMENT_BOOKING VALUES(" . $pDocumentId . ", " . $idBooking . ");";
                pg_query($this->connection, $sql);
            }
        }
    }


    public function getReportBookingPerDay()
    {

        $sql = "SELECT date_start , count(booking_id) as fecha
                FROM booking
                WHERE date_start > now() - interval '2 week' GROUP BY date_start ORDER BY date_start ";


        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {
            $date = new DateTime($row['date_start']);
            array_push($data, array("year" => $date->format('y'), "month" => $date->format('m') - 1, "day" => $date->format('d'), "count" => $row['fecha']));
        }

        return $data;
    }
    public function getReportBookingsPerYear($pYear)
    {

        $sql = "SELECT 
                    EXTRACT(MONTH FROM date_start) as month, count(booking_id) as count
                FROM 
                    BOOKING 
                WHERE 
                    EXTRACT(YEAR FROM date_start) = " . $pYear . "
                    GROUP BY month 
                    ORDER BY month ASC";


        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        $rows = pg_fetch_all($result);
        $aux = 0;

        for ($i = 0; $i < 12; $i++) {
            if (isset($rows[$aux]) == true and number_format($rows[$aux]['month']) == ($i + 1)) {
                array_push($data, array("month" => $rows[$aux]['month'], "count" => $rows[$aux]['count']));
                $aux = $aux + 1;
            } else {
                array_push($data, array("month" => ($i + 1), "count" => 0));
            }
        }
        return $data;
    }



    public function getValueFined()
    {
        return self::$valueFinedPerDay;
    }

    public static function getBookingDAO($connection)
    {
        if (self::$bookingDAO == null) {
            self::$bookingDAO = new BookingDAO($connection);
        }

        return self::$bookingDAO;
    }
}