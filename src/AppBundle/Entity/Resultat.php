<?php

namespace AppBundle\Entity;

/**
 * Resultat
 */
class Resultat
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $nbVoix;


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
     * Set nbVoix
     *
     * @param integer $nbVoix
     *
     * @return Resultat
     */
    public function setNbVoix($nbVoix)
    {
        $this->nbVoix = $nbVoix;

        return $this;
    }

    /**
     * Get nbVoix
     *
     * @return int
     */
    public function getNbVoix()
    {
        return $this->nbVoix;
    }
    /**
     * @var \AppBundle\Entity\Commune
     */
    private $commune;

    /**
     * @var \AppBundle\Entity\Candidat
     */
    private $candidat;

    /**
     * @var \AppBundle\Entity\Tour
     */
    private $tour;


    /**
     * Set commune
     *
     * @param \AppBundle\Entity\Commune $commune
     *
     * @return Resultat
     */
    public function setCommune(\AppBundle\Entity\Commune $commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \AppBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set candidat
     *
     * @param \AppBundle\Entity\Candidat $candidat
     *
     * @return Resultat
     */
    public function setCandidat(\AppBundle\Entity\Candidat $candidat)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \AppBundle\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return Resultat
     */
    public function setTour(\AppBundle\Entity\Tour $tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \AppBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }
    /**
     * @var \DateTime
     */
    private $date;


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Resultat
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
