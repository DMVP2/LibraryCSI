<?php

/**
 * Class representing the "Document" class
 */

class Document
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $document_id;
    private $code;
    private $title;
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
    private $status;
    private $image;

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

    public function getDocumentId()
    {
        return $this->document_id;
    }

    public function setId($pId)
    {
        $this->document_id = $pId;
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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($pStatus)
    {
        $this->status = $pStatus;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($pImage)
    {
        $this->image = $pImage;
    }
}