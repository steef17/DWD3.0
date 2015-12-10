<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blacklist
 *
 * @ORM\Table(name="blacklist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlacklistRepository")
 */
class Blacklist
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
     * @return Blacklist
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
}

