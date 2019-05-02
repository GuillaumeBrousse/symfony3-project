<?php

namespace AppBundle\Entity;

/**
 * Commune
 */
class Commune
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
     * @return Commune
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Commune
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
    private $resultat;

    /**
     * @var \AppBundle\Entity\Departement
     */
    private $departement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add resultat
     *
     * @param \AppBundle\Entity\Resultat $resultat
     *
     * @return Commune
     */
    public function addResultat(\AppBundle\Entity\Resultat $resultat)
    {
        $this->resultat[] = $resultat;

        return $this;
    }

    /**
     * Remove resultat
     *
     * @param \AppBundle\Entity\Resultat $resultat
     */
    public function removeResultat(\AppBundle\Entity\Resultat $resultat)
    {
        $this->resultat->removeElement($resultat);
    }

    /**
     * Get resultat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set departement
     *
     * @param \AppBundle\Entity\Departement $departement
     *
     * @return Commune
     */
    public function setDepartement(\AppBundle\Entity\Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \AppBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mention;


    /**
     * Add mention
     *
     * @param \AppBundle\Entity\Mention $mention
     *
     * @return Commune
     */
    public function addMention(\AppBundle\Entity\Mention $mention)
    {
        $this->mention[] = $mention;

        return $this;
    }

    /**
     * Remove mention
     *
     * @param \AppBundle\Entity\Mention $mention
     */
    public function removeMention(\AppBundle\Entity\Mention $mention)
    {
        $this->mention->removeElement($mention);
    }

    /**
     * Get mention
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMention()
    {
        return $this->mention;
    }
}
