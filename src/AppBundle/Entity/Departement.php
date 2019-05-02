<?php

namespace AppBundle\Entity;

/**
 * Departement
 */
class Departement
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
    private $codeMin;

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
     * @return Departement
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
     * @return Departement
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
     * Set codeMin
     *
     * @param string $codeMin
     *
     * @return Departement
     */
    public function setCodeMin($codeMin)
    {
        $this->codeMin = $codeMin;

        return $this;
    }

    /**
     * Get codeMin
     *
     * @return string
     */
    public function getCodeMin()
    {
        return $this->codeMin;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Departement
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
    private $commune;

    /**
     * @var \AppBundle\Entity\Region
     */
    private $region;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commune = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commune
     *
     * @param \AppBundle\Entity\Commune $commune
     *
     * @return Departement
     */
    public function addCommune(\AppBundle\Entity\Commune $commune)
    {
        $this->commune[] = $commune;

        return $this;
    }

    /**
     * Remove commune
     *
     * @param \AppBundle\Entity\Commune $commune
     */
    public function removeCommune(\AppBundle\Entity\Commune $commune)
    {
        $this->commune->removeElement($commune);
    }

    /**
     * Get commune
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set region
     *
     * @param \AppBundle\Entity\Region $region
     *
     * @return Departement
     */
    public function setRegion(\AppBundle\Entity\Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \AppBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }
}
