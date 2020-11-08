<?php

/**
 * Class representing the "Document" class
 */

class Document
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $id;
    private $code;
    private $title;
    private $state;
    private $authors;
    private $congress;
    private $category;
    private $language;
    private $numOfPages;
    private $dateOfPublication;
    private $editorial;
    private $type;
    private $city;
    private $country;

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */

    //----------------------------------
    // Methods
    //----------------------------------

    /**
     * 
     */

    public function getId()
    {
        return $this->id;
    }

    public function setId($pId)
    {
        $this->id = $pId;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($pCode)
    {
        $this->code = $pCode;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($pTitle)
    {
        $this->title = $pTitle;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($pState)
    {
        $this->state = $pState;
    }

    public function getAuthors()
    {
        return $this->authors;
    }

    public function setAuthors($pAuthors)
    {
        $this->authors = $pAuthors;
    }

    public function getCongress()
    {
        return $this->congress;
    }

    public function setCongress($pCongress)
    {
        $this->congress = $pCongress;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($pCategory)
    {
        $this->category = $pCategory;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($pLanguage)
    {
        $this->language = $pLanguage;
    }

    public function getNumOfPages()
    {
        return $this->numOfPages;
    }

    public function setNumOfPages($pNumOfPages)
    {
        $this->numOfPages = $pNumOfPages;
    }

    public function getDateOfPublication()
    {
        return $this->dateOfPublication;
    }

    public function setDateOfPublication($pDateOfPublication)
    {
        $this->dateOfPublication = $pDateOfPublication;
    }

    public function getEditorial()
    {
        return $this->editorial;
    }

    public function setEditorial($pEditorial)
    {
        $this->editorial = $pEditorial;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($pType)
    {
        $this->type = $pType;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($pCity)
    {
        $this->city = $pCity;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($pCountry)
    {
        $this->country = $pCountry;
    }
}