<?php

/**
 * Class representing the "User" class
 */

class User
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $user_id;
    private $identification_type;
    private $name;
    private $last_name;
    private $mail;
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

    public function createPassword()
    {

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudPass = 8;
        $longitudCadena = strlen($cadena);
        $password = "";

        for ($i = 1; $i <= $longitudPass; $i++) {

            $pos = rand(0, $longitudCadena - 1);

            $password .= substr($cadena, $pos, 1);
        }

        return $password;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setId($pUserId)
    {
        $this->user_id = $pUserId;
    }

    public function getTypeDocument()
    {
        return $this->identification_type;
    }

    public function setIdentificationType($pIdentificationType)
    {
        $this->identification_type = $pIdentificationType;
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
        return $this->last_name;
    }

    public function setLastName($pLastName)
    {
        $this->last_name = $pLastName;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($pMail)
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

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($pPassword)
    {
        $this->password = $pPassword;
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