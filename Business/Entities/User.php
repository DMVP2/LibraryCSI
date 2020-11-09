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
    private $typeDocument;
    private $name;
    private $lastName;
    private $email;
    private $phone;
    private $password;
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

    public function getTypeDocument()
    {
        return $this->typeDocument;
    }

    public function setTypeDocument($pTypeDocument)
    {
        $this->typeDocument = $pTypeDocument;
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

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($pPhone)
    {
        $this->phone = $pPhone;
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
        return $this->role;
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