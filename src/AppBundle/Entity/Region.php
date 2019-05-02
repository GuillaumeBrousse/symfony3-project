<?php

namespace AppBundle\Entity;

/**
 * Region
 */
class Region
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $code3;

    /**
     * @var string
     */
    private $libelle;


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
     * Set code
     *
     * @param string $code
     *
     * @return Region
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code3
     *
     * @param string $code3
     *
     * @return Region
     */
    public function setCode3($code3)
    {
        $this->code3 = $code3;

        return $this;
    }

    /**
     * Get code3
     *
     * @return string
     */
    public function getCode3()
    {
        return $this->code3;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Region
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $departement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departement
     *
     * @param \AppBundle\Entity\Departement $departement
     *
     * @return Region
     */
    public function addDepartement(\AppBundle\Entity\Departement $departement)
    {
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \AppBundle\Entity\Departement $departement
     */
    public function removeDepartement(\AppBundle\Entity\Departement $departement)
    {
        $this->departement->removeElement($departement);
    }

    /**
     * Get departement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
