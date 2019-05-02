<?php

namespace AppBundle\Entity;

/**
 * Tour
 */
class Tour
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Tour
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
     * @return Tour
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mention;


    /**
     * Add mention
     *
     * @param \AppBundle\Entity\Mention $mention
     *
     * @return Tour
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
