<?php

namespace DigitalFarm\Model;

class Offer extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="hash", type="string", length=255, nullable=false)
     */
    protected $hash;

    /**
     *
     * @var string
     * @Column(column="sourcePortal", type="string", length=255, nullable=false)
     */
    protected $sourcePortal;

    /**
     *
     * @var string
     * @Column(column="position", type="string", length=255, nullable=false)
     */
    protected $position;

    /**
     *
     * @var string
     * @Column(column="companyName", type="string", length=255, nullable=false)
     */
    protected $companyName;

    /**
     *
     * @var string
     * @Column(column="companyAddress", type="string", length=255, nullable=true)
     */
    protected $companyAddress;

    /**
     *
     * @var string
     * @Column(column="companyCity", type="string", length=255, nullable=true)
     */
    protected $companyCity;

    /**
     *
     * @var string
     * @Column(column="companySize", type="string", length=53, nullable=true)
     */
    protected $companySize;

    /**
     *
     * @var string
     * @Column(column="companyCountry", type="string", length=255, nullable=true)
     */
    protected $companyCountry;

    /**
     *
     * @var string
     * @Column(column="companyUrl", type="string", length=511, nullable=true)
     */
    protected $companyUrl;

    /**
     *
     * @var string
     * @Column(column="companyLogoUrl", type="string", length=511, nullable=true)
     */
    protected $companyLogoUrl;

    /**
     *
     * @var string
     * @Column(column="companyLatitude", type="string", length=255, nullable=true)
     */
    protected $companyLatitude;

    /**
     *
     * @var string
     * @Column(column="companyLongitude", type="string", length=255, nullable=true)
     */
    protected $companyLongitude;

    /**
     *
     * @var integer
     * @Column(column="minEarnings", type="integer", nullable=true)
     */
    protected $minEarnings;

    /**
     *
     * @var integer
     * @Column(column="maxEarnings", type="integer", nullable=true)
     */
    protected $maxEarnings;

    /**
     *
     * @var string
     * @Column(column="currency", type="string", nullable=true)
     */
    protected $currency;

    /**
     *
     * @var string
     * @Column(column="employmentType", type="string", length=255, nullable=true)
     */
    protected $employmentType;

    /**
     *
     * @var string
     * @Column(column="isRemote", type="string", nullable=true)
     */
    protected $isRemote;

    /**
     *
     * @var string
     * @Column(column="isActive", type="string", nullable=true)
     */
    protected $isActive = true;

    /**
     *
     * @var string
     * @Column(column="description", type="string", nullable=true)
     */
    protected $description;

    /**
     *
     * @var string
     * @Column(column="technologies", type="string", nullable=true)
     */
    protected $tags;

    /**
     *
     * @var string
     * @Column(column="mainTechnology", type="string", length=255, nullable=true)
     */
    protected $mainTechnology;

    /**
     *
     * @var string
     * @Column(column="category", type="string", length=255, nullable=true)
     */
    protected $category;

    /**
     *
     * @var string
     * @Column(column="offertUrl", type="string", length=511, nullable=false)
     */
    protected $offertUrl;

    /**
     *
     * @var string
     * @Column(column="seniority", type="string", length=255, nullable=true)
     */
    protected $seniority;

    /**
     *
     * @var string
     * @Column(column="addedDatetime", type="string", nullable=false)
     */
    protected $addedDatetime;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field hash
     *
     * @param string $hash
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Method to set the value of field sourcePortal
     *
     * @param string $sourcePortal
     * @return $this
     */
    public function setSourcePortal($sourcePortal)
    {
        $this->sourcePortal = $sourcePortal;

        return $this;
    }

    /**
     * Method to set the value of field position
     *
     * @param string $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Method to set the value of field companyName
     *
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Method to set the value of field companyAddress
     *
     * @param string $companyAddress
     * @return $this
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Method to set the value of field companyCity
     *
     * @param string $companyCity
     * @return $this
     */
    public function setCompanyCity($companyCity)
    {
        $this->companyCity = $companyCity;

        return $this;
    }

    /**
     * Method to set the value of field companySize
     *
     * @param string $companySize
     * @return $this
     */
    public function setCompanySize($companySize)
    {
        $this->companySize = $companySize;

        return $this;
    }

    /**
     * Method to set the value of field companyCountry
     *
     * @param string $companyCountry
     * @return $this
     */
    public function setCompanyCountry($companyCountry)
    {
        $this->companyCountry = $companyCountry;

        return $this;
    }

    /**
     * Method to set the value of field companyUrl
     *
     * @param string $companyUrl
     * @return $this
     */
    public function setCompanyUrl($companyUrl)
    {
        $this->companyUrl = $companyUrl;

        return $this;
    }

    /**
     * Method to set the value of field companyLogoUrl
     *
     * @param string $companyLogoUrl
     * @return $this
     */
    public function setCompanyLogoUrl($companyLogoUrl)
    {
        $this->companyLogoUrl = $companyLogoUrl;

        return $this;
    }

    /**
     * Method to set the value of field companyLatitude
     *
     * @param string $companyLatitude
     * @return $this
     */
    public function setCompanyLatitude($companyLatitude)
    {
        $this->companyLatitude = $companyLatitude;

        return $this;
    }

    /**
     * Method to set the value of field companyLongitude
     *
     * @param string $companyLongitude
     * @return $this
     */
    public function setCompanyLongitude($companyLongitude)
    {
        $this->companyLongitude = $companyLongitude;

        return $this;
    }

    /**
     * Method to set the value of field minEarnings
     *
     * @param integer $minEarnings
     * @return $this
     */
    public function setMinEarnings($minEarnings)
    {
        $this->minEarnings = $minEarnings;

        return $this;
    }

    /**
     * Method to set the value of field maxEarnings
     *
     * @param integer $maxEarnings
     * @return $this
     */
    public function setMaxEarnings($maxEarnings)
    {
        $this->maxEarnings = $maxEarnings;

        return $this;
    }

    /**
     * Method to set the value of field employmentType
     *
     * @param string $employmentType
     * @return $this
     */
    public function setEmploymentType($employmentType)
    {
        $this->employmentType = $employmentType;

        return $this;
    }

    /**
     * Method to set the value of field isRemote
     *
     * @param string $isRemote
     * @return $this
     */
    public function setIsRemote($isRemote)
    {
        $this->isRemote = $isRemote;

        return $this;
    }

    /**
     * Method to set the value of field isRemote
     *
     * @param bool $isRemote
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field technologies
     *
     * @param array $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = \json_encode($tags);

        return $this;
    }

    /**
     * Method to set the value of field mainTechnology
     *
     * @param string $mainTechnology
     * @return $this
     */
    public function setMainTechnology($mainTechnology)
    {
        $this->mainTechnology = $mainTechnology;

        return $this;
    }

    /**
     * Method to set the value of field offertUrl
     *
     * @param string $offertUrl
     * @return $this
     */
    public function setOffertUrl($offertUrl)
    {
        $this->offertUrl = $offertUrl;

        return $this;
    }

    /**
     * Method to set the value of field seniority
     *
     * @param string $seniority
     * @return $this
     */
    public function setSeniority($seniority)
    {
        $this->seniority = $seniority;

        return $this;
    }

    /**
     * Method to set the value of field addedDatetime
     *
     * @param string $addedDatetime
     * @return $this
     */
    public function setAddedDatetime($addedDatetime)
    {
        $this->addedDatetime = $addedDatetime;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Returns the value of field sourcePortal
     *
     * @return string
     */
    public function getSourcePortal()
    {
        return $this->sourcePortal;
    }

    /**
     * Returns the value of field position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Returns the value of field companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Returns the value of field companyAddress
     *
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Returns the value of field companyCity
     *
     * @return string
     */
    public function getCompanyCity()
    {
        return $this->companyCity;
    }

    /**
     * Returns the value of field companySize
     *
     * @return string
     */
    public function getCompanySize()
    {
        return $this->companySize;
    }

    /**
     * Returns the value of field companyCountry
     *
     * @return string
     */
    public function getCompanyCountry()
    {
        return $this->companyCountry;
    }

    /**
     * Returns the value of field companyUrl
     *
     * @return string
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
    }

    /**
     * Returns the value of field companyLogoUrl
     *
     * @return string
     */
    public function getCompanyLogoUrl()
    {
        return $this->companyLogoUrl;
    }

    /**
     * Returns the value of field companyLatitude
     *
     * @return string
     */
    public function getCompanyLatitude()
    {
        return $this->companyLatitude;
    }

    /**
     * Returns the value of field companyLongitude
     *
     * @return string
     */
    public function getCompanyLongitude()
    {
        return $this->companyLongitude;
    }

    /**
     * Returns the value of field minEarnings
     *
     * @return integer
     */
    public function getMinEarnings()
    {
        return $this->minEarnings;
    }

    /**
     * Returns the value of field maxEarnings
     *
     * @return integer
     */
    public function getMaxEarnings()
    {
        return $this->maxEarnings;
    }

    /**
     * Returns the value of field employmentType
     *
     * @return string
     */
    public function getEmploymentType()
    {
        return $this->employmentType;
    }

    /**
     * Returns the value of field isRemote
     *
     * @return string
     */
    public function getIsRemote()
    {
        return $this->isRemote;
    }

    /**
     * Returns the value of field isRemote
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field technologies
     *
     * @return string
     */
    public function getTags()
    {
        return \json_decode($this->tags, true);
    }

    /**
     * Returns the value of field mainTechnology
     *
     * @return string
     */
    public function getMainTechnology()
    {
        return $this->mainTechnology;
    }

    /**
     * Returns the value of field offertUrl
     *
     * @return string
     */
    public function getOffertUrl()
    {
        return $this->offertUrl;
    }

    /**
     * Returns the value of field seniority
     *
     * @return string
     */
    public function getSeniority()
    {
        return $this->seniority;
    }

    /**
     * Returns the value of field addedDatetime
     *
     * @return string
     */
    public function getAddedDatetime()
    {
        return $this->addedDatetime;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("offer");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Offer[]|Offer|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Offer|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
