<?php

/**
 * Class representing the "User" class
 */

class User
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $id;
    private $name;
    private $lastName;
    private $password;
    private $email;
    private $role;
    private $status;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($pName)
    {
        $this->name = $pName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($pLastName)
    {
        $this->lastName = $pLastName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($pPassword)
    {
        $this->password = $pPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($pEmail)
    {
        $this->id = $pEmail;
    }

    public function getRole()
    {
        return $this->id;
    }

    public function setRole($pRole)
    {
        $this->role = $pRole;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($pStatus)
    {
        $this->status = $pStatus;
    }
}