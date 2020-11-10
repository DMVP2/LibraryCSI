<?php

/**
 * Class representing the "Penalty" class
 */

class Penalty
{
    //----------------------------------
    // Attributes
    //----------------------------------
    private $id;
    private $dateStart;
    private $dateEnd;
    private $value;
    private $status;
    private $userId;
    private $bookingId;

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

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function setDateStart($pDateStart)
    {
        $this->dateStart = $pDateStart;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setDateEnd($pDateEnd)
    {
        $this->dateEnd = $pDateEnd;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($pValue)
    {
        $this->value = $pValue;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($pStatus)
    {
        $this->status = $pStatus;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($pUserId)
    {
        $this->userId = $pUserId;
    }
    public function getBookingId()
    {
        return $this->bookingId;
    }

    public function setBookingId($pBookingId)
    {
        $this->bookingId = $pBookingId;
    }
}