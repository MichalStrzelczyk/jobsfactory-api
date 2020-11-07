<?php

namespace DigitalFarm\Model;

class Advertisement extends \Phalcon\Mvc\Model
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
     * @Column(column="actionLabel", type="string", nullable=true)
     */
    protected $actionLabel;

    /**
     *
     * @var string
     * @Column(column="actionLink", type="string", nullable=true)
     */
    protected $actionLink;

    /**
     *
     * @var string
     * @Column(column="imageUrl", type="string", nullable=false)
     */
    protected $imageUrl;

    /**
     *
     * @var integer
     * @Column(column="imageViews", type="integer", nullable=true)
     */
    protected $imageViews;

    /**
     *
     * @var integer
     * @Column(column="ctaClicks", type="integer", nullable=true)
     */
    protected $ctaClicks;

    /**
     *
     * @var string
     * @Column(column="isActive", type="string", nullable=true)
     */
    protected $isActive;

    /**
     *
     * @var string
     * @Column(column="activatedFrom", type="string", nullable=true)
     */
    protected $activatedFrom;

    /**
     *
     * @var string
     * @Column(column="activatedTo", type="string", nullable=true)
     */
    protected $activatedTo;

    /**
     *
     * @var string
     * @Column(column="rule", type="string", nullable=true)
     */
    protected $rule;

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
     * Method to set the value of field actionLabel
     *
     * @param string $actionLabel
     * @return $this
     */
    public function setActionLabel($actionLabel)
    {
        $this->actionLabel = $actionLabel;

        return $this;
    }

    /**
     * Method to set the value of field actionLink
     *
     * @param string $actionLink
     * @return $this
     */
    public function setActionLink($actionLink)
    {
        $this->actionLink = $actionLink;

        return $this;
    }

    /**
     * Method to set the value of field imageUrl
     *
     * @param string $imageUrl
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Method to set the value of field imageViews
     *
     * @param integer $imageViews
     * @return $this
     */
    public function setImageViews($imageViews)
    {
        $this->imageViews = $imageViews;

        return $this;
    }

    /**
     * Method to set the value of field ctaClicks
     *
     * @param integer $ctaClicks
     * @return $this
     */
    public function setCtaClicks($ctaClicks)
    {
        $this->ctaClicks = $ctaClicks;

        return $this;
    }

    /**
     * Method to set the value of field isActive
     *
     * @param string $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Method to set the value of field activatedFrom
     *
     * @param string $activatedFrom
     * @return $this
     */
    public function setActivatedFrom($activatedFrom)
    {
        $this->activatedFrom = $activatedFrom;

        return $this;
    }

    /**
     * Method to set the value of field activatedTo
     *
     * @param string $activatedTo
     * @return $this
     */
    public function setActivatedTo($activatedTo)
    {
        $this->activatedTo = $activatedTo;

        return $this;
    }

    /**
     * Method to set the value of field rule
     *
     * @param string $rule
     * @return $this
     */
    public function setRule($rule)
    {
        $this->rule = $rule;

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
     * Returns the value of field actionLabel
     *
     * @return string
     */
    public function getActionLabel()
    {
        return $this->actionLabel;
    }

    /**
     * Returns the value of field actionLink
     *
     * @return string
     */
    public function getActionLink()
    {
        return $this->actionLink;
    }

    /**
     * Returns the value of field imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Returns the value of field imageViews
     *
     * @return integer
     */
    public function getImageViews()
    {
        return $this->imageViews;
    }

    /**
     * Returns the value of field ctaClicks
     *
     * @return integer
     */
    public function getCtaClicks()
    {
        return $this->ctaClicks;
    }

    /**
     * Returns the value of field isActive
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Returns the value of field activatedFrom
     *
     * @return string
     */
    public function getActivatedFrom()
    {
        return $this->activatedFrom;
    }

    /**
     * Returns the value of field activatedTo
     *
     * @return string
     */
    public function getActivatedTo()
    {
        return $this->activatedTo;
    }

    /**
     * Returns the value of field rule
     *
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("advertisement");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Advertisement[]|Advertisement|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Advertisement|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
