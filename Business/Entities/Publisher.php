<?php

/**
 * Class representing the "Publisher" class
 */

class Publisher
{

    //----------------------------------
    // Attributes
    //----------------------------------
    private $document;
    private $typeDocument;
    private $businessName;
    private $mail;
    private $phone;
    private $type;
    private $status;
    private $attendant;
    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */

    //----------------------------------
    // Methods
    //----------------------------------

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($pDocument)
    {
        $this->document = $pDocument;
    }

    public function getTypeDocument()
    {
        return $this->typeDocument;
    }

    public function setTypeDocument($pTypeDocument)
    {
        $this->typeDocument = $pTypeDocument;
    }

    public function getBusinessName()
    {
        return $this->businessName;
    }

    public function setBusinessName($pBusinessName)
    {
        $this->businessName = $pBusinessName;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setEmail($pMail)
    {
        $this->mail = $pMail;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($pPhone)
    {
        $this->phone = $pPhone;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($pType)
    {
        $this->type = $pType;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($pStatus)
    {
        $this->status = $pStatus;
    }

    public function getAttendant()
    {
        return $this->attendant;
    }

    public function setAttendant($pAttendant)
    {
        $this->attendant = $pAttendant;
    }
}