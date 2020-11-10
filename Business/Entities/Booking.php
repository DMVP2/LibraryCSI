<?php

/**
 * Class representing the "Booking" class
 */

class Booking
{
    //----------------------------------
    // Attributes
    //----------------------------------
    private $id;
    private $idDocument;
    private $idUser;
    private $bookingStatus;
    private $bookingDate;
    private $deliveryDate;
    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */

    //----------------------------------
    // Methods
    //----------------------------------

    public function getId()
    {
        return $this->id;
    }

    public function setId($pId)
    {
        $this->id = $pId;
    }

    public function getIdDocument()
    {
        return $this->idDocument;
    }

    public function setIdDocument($pIdDocument)
    {
        $this->idDocument = $pIdDocument;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($pIdUser)
    {
        $this->idUser = $pIdUser;
    }

    public function getBookingStatus()
    {
        return $this->bookingStatus;
    }

    public function setBookingStatus($pBookingStatus)
    {
        $this->bookingStatus = $pBookingStatus;
    }

    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    public function setBookingDate($pBookingDate)
    {
        $this->bookingDate = $pBookingDate;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate($pDeliveryDate)
    {
        $this->deliveryDate = $pDeliveryDate;
    }
}