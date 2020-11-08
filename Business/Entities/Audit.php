<?php

/**
 * Class representing the "Audit" class
 */

class Audit
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $id;
    private $user;
    private $table;
    private $ip;
    private $operation;
    private $date;
    private $oldData;
    private $newData;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($pUser)
    {
        $this->user = $pUser;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($pTable)
    {
        $this->table = $pTable;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($pIp)
    {
        $this->ip = $pIp;
    }

    public function getOperation()
    {
        return $this->operation;
    }

    public function setOperation($pOperation)
    {
        $this->operation = $pOperation;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function seDate($pDate)
    {
        $this->date = $pDate;
    }

    public function getOldData()
    {
        return $this->oldData;
    }

    public function setOldData($pOldData)
    {
        $this->oldData = $pOldData;
    }

    public function getNewData()
    {
        return $this->newData;
    }

    public function setNewData($pNewData)
    {
        $this->newData = $pNewData;
    }
}