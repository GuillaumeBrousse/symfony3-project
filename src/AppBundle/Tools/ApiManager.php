<?php

namespace AppBundle\Tools;

use AppBundle\Entity\Region;
use AppBundle\Entity\Departement;
use AppBundle\Entity\Commune;
use AppBundle\Entity\Candidat;
use AppBundle\Entity\LastUpdate;
use AppBundle\Entity\Mention;
use AppBundle\Entity\Resultat;
use AppBundle\Entity\Tour;
use Symfony\Component\Debug\Exception\ContextErrorException;

class ApiManager
{
    private $em;
	private $url;

	public function __construct($em)
	{
        $this->em = $em;
	}

    public function setConfig( $config )
    {
        $this->url = $config[ 'url' ];
    }


    public function fillDatabase()
    {
        $this->fillRegDptCom();
        $this->fillCandidat();
    }

    private function fillRegDptCom()
    {
        $xmlRegDptCom = $this->url.'referencePR/listeregdptcom.xml';
        $data = new \SimpleXMLElement($xmlRegDptCom, null, true);


        if(count($data->Regions->Region) != count($this->em->getRepository('AppBundle:Region')->findAll())){
            foreach ($data->Regions->Region as $region) {
                $tmpRegion = $this->em->getRepository('AppBundle:Region')->findOneByCode($region->CodReg->__toString());
                if(!$tmpRegion){
                    $tmpRegion = new Region();
                    $this->em->persist($tmpRegion);
                    $tmpRegion->setCode($region->CodReg->__toString());
                    $tmpRegion->setCode3($region->CodReg3Car->__toString());
                    $tmpRegion->setLibelle($region->LibReg->__toString());
                }
                if(count($region->Departements->Departement) != $tmpRegion->getDepartement()->count()){
                    foreach ($region->Departements->Departement as $departement) {
                        $tmpDepartement = $this->em->getRepository('AppBundle:Departement')->findOneByCode($region->CodReg->__toString());
                        if(!$tmpDepartement){
                            $tmpDepartement = new Departement();
                            $this->em->persist($tmpDepartement);
                            $tmpDepartement->setCode($departement->CodDpt->__toString());
                            $tmpDepartement->setCodeMin($departement->CodMinDpt->__toString());
                            $tmpDepartement->setCode3($departement->CodDpt3Car->__toString());
                            $tmpDepartement->setLibelle($departement->LibDpt->__toString());
                            $tmpDepartement->setRegion($tmpRegion);
                        }
                        if(count($departement->Communes->Commune) != $tmpDepartement->getCommune()->count()){
                            foreach ($departement->Communes->Commune as $commune) {
                                $tmpCommune = new Commune();
                                $tmpCommune->setCode($commune->CodSubCom->__toString());
                                $tmpCommune->setLibelle($commune->LibSubCom->__toString());
                                $tmpCommune->setDepartement($tmpDepartement);
                                $this->em->persist($tmpCommune);
                            }
                        }
                    }                
                }
            }
        }
        $this->em->flush();
    }

    private function fillCandidat()
    {
        $xmlCandidat = $this->url.'candidatureT1/CandidatureT1.xml';
        $data = new \SimpleXMLElement($xmlCandidat, null, true);

        if(count($data->Candidats->Candidat) != count($this->em->getRepository('AppBundle:Candidat')->findAll())){
            foreach ($data->Candidats->Candidat as $candidat) {
                $tmpCandidat = new Candidat();
                $tmpCandidat->setNumero($candidat->NumPanneauCand->__toString());
                $tmpCandidat->setNom($candidat->NomPsn->__toString());
                $tmpCandidat->setPrenom($candidat->PrenomPsn->__toString());
                $tmpCandidat->setCivilite($candidat->CivilitePsn->__toString());
                $this->em->persist($tmpCandidat);
            }
        }
        $this->em->flush();
    }


    public function updateData()
    {
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        $numTour = new \DateTime() < \DateTime::createFromFormat('d/m/Y', '07/05/2017') ? 1 : 2;
        $tour = $this->em->getRepository('AppBundle:Tour')->findOneByNumero($numTour);
        if(!$tour){
            $tour = new Tour();
            $tour->setNumero($numTour);
            $this->em->persist($tour);
        }

        $lastUpdate = $this->em->getRepository('AppBundle:LastUpdate')->get();
        $departements = $this->em->getRepository('AppBundle:Departement')->getDepWithCommuneWhitoutMention();
        $candidats =  $this->em->getRepository('AppBundle:Candidat')->findAll();
        $arrayCandidats = array();
        foreach ($candidats as $candidat) {
            $arrayCandidats[$candidat->getNumero()] = $candidat;
        }
        $errors = array();

        if(!$lastUpdate){
            $lastUpdate = new LastUpdate();
            $lastUpdate->setDate(new \DateTime());
            $this->em->persist($lastUpdate);
        }elseif($lastUpdate->getDate() < new \DateTime('+5 minute')){
            $lastUpdate->setDate(new \DateTime());
            $i = 0;
            
            foreach ($departements as $departement) {
                foreach ($departement->getCommune() as $commune) {
                    if(!$commune->getMention()->last()){
                        try {
                            $url = $this->url.'resultatsT'.$tour->getNumero().'/'.$departement->getRegion()->getCode3().'/'.$departement->getCode3().'/'.$departement->getCode3().$commune->getCode().'.xml';

                            $tmpData = new \SimpleXMLElement(file_get_contents($url));

                            $tmpMention = $tmpData->Departement->Commune->Tours->Tour->Mentions;
                            $mention = new Mention();
                            $mention->setDate(new \DateTime());
                            $mention->setTour($tour);
                            $mention->setCommune($commune);
                            $mention->setInscrits($tmpMention->Inscrits->Nombre->__toString());
                            $mention->setAbstentions($tmpMention->Abstentions->Nombre->__toString());
                            $mention->setVotants($tmpMention->Votants->Nombre->__toString());
                            $mention->setBlancs($tmpMention->Blancs->Nombre->__toString());
                            $mention->setNuls($tmpMention->Nuls->Nombre->__toString());
                            $mention->setExprimes($tmpMention->Exprimes->Nombre->__toString());
                            $this->em->persist($mention);
                            $i++;

                            $tmpResultat = $tmpData->Departement->Commune->Tours->Tour->Resultats;
                            foreach ($tmpResultat->Candidats->Candidat as $tmpCandidat) {
                                $candidat = $arrayCandidats[$tmpCandidat->NumPanneauCand->__toString()];
                                $resultat = new Resultat();
                                $resultat->setTour($tour);
                                $resultat->setCandidat($candidat);
                                $resultat->setCommune($commune);
                                $resultat->setDate(new \DateTime());
                                $resultat->setNbVoix($tmpCandidat->NbVoix->__toString());
                                $this->em->persist($resultat);
                                $i++;
                            }
                            if($i > 130){
                                $this->em->flush();
                                $i = 0;
                                //$this->em->clear();
                            }
                        } catch (\Exception $e) {
                            $errors[] = $url;
                            //dump($url);
                        }
                    }
                }
                $this->em->flush();
            }
        }
        $this->em->flush();
    }
}