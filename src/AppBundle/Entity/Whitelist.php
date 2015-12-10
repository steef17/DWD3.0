<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Whitelist
 *
 * @ORM\Table(name="whitelist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WhitelistRepository")
 */
class Whitelist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="CustomerID", type="integer", unique=true)
     */
    private $customerID;

    /**
     * @var int
     *
     * @ORM\Column(name="Filter", type="integer", unique=true)
     */
    private $filter;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customerID
     *
     * @param integer $customerID
     *
     * @return Whitelist
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * Get customerID
     *
     * @return int
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * Set filter
     *
     * @param integer $filter
     *
     * @return Whitelist
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return int
     */
    public function getFilter()
    {
        return $this->filter;
    }
}

