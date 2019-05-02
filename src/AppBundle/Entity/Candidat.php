<?php

namespace AppBundle\Entity;

/**
 * Candidat
 */
class Candidat
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $numero;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $civilite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->nom.' '.$this->prenom;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Candidat
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Candidat
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Candidat
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Candidat
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $resultat;

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
     * @return Candidat
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
     * @var \AppBundle\Entity\Nuance
     */
    private $nuance;


    /**
     * Set nuance
     *
     * @param \AppBundle\Entity\Nuance $nuance
     *
     * @return Candidat
     */
    public function setNuance(\AppBundle\Entity\Nuance $nuance = null)
    {
        $this->nuance = $nuance;

        return $this;
    }

    /**
     * Get nuance
     *
     * @return \AppBundle\Entity\Nuance
     */
    public function getNuance()
    {
        return $this->nuance;
    }
}
