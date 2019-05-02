<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $api = $this->get('api.manager');
        $api->fillDatabase();
        $api->updateData();
        $globalResults = $em->getRepository('AppBundle:Candidat')->getGlobalResultats();
        $totalVotants = $em->getRepository('AppBundle:Mention')->getGlobalTotalVotant();
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getGlobalTotalInscrit();
        
        return $this->render('::render/index.html.twig', array(
            'globalResults' => $globalResults,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
    }

    public function trombinoscopeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $api = $this->get('api.manager');
        $globalResults = $em->getRepository('AppBundle:Candidat')->getGlobalResultats();
        $totalVotants = $em->getRepository('AppBundle:Mention')->getGlobalTotalVotant();
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getGlobalTotalInscrit();
        return $this->render('::render/trombinoscope.html.twig', array(
            'globalResults' => $globalResults,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
    }


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $search = $request->get('search');

        $regions = $em->getRepository('AppBundle:Region')->search($search);
        $departements = $em->getRepository('AppBundle:Departement')->search($search);
        $communes = $em->getRepository('AppBundle:Commune')->search($search);

        $result = array();

        foreach ($regions as $region) {
            $this->generateUrl('region_show', array('id' => $region->getId()));
            $result[] = (object) array(
                'id' => $this->generateUrl('region_show', array('id' => $region->getId())), 
                'value' => $region->getLibelle(),
                'label' => $region->getLibelle(),
            );
        }

        foreach ($departements as $departement) {
            $this->generateUrl('departement_show', array('id' => $departement->getId()));
            $result[] = (object) array(
                'id' => $this->generateUrl('departement_show', array('id' => $departement->getId())), 
                'value' => $departement->getLibelle(),
                'label' => $departement->getLibelle(),
            );
        }

        foreach ($communes as $commune) {
            $this->generateUrl('commune_show', array('id' => $commune->getId()));
            $result[] = (object) array(
                'id' => $this->generateUrl('commune_show', array('id' => $commune->getId())), 
                'value' => $commune->getLibelle().', '.$commune->getDepartement()->getLibelle(),
                'label' => $commune->getLibelle().', '.$commune->getDepartement()->getLibelle(),
            );
        }

        $response = new JsonResponse();
        $response->setData($result);
        return $response;

    }


    public function mapAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('AppBundle:Candidat')->find($request->get('id'));

        $results = $em->getRepository('AppBundle:Resultat')->getResultsByCandidat($candidat);
        $r = array();
        foreach ($results as $result) {
            $r[] = (object)array(
                "departement" => $result['result']->getCommune()->getDepartement()->getCodeMin(),
                "pourcentage_votant" => round(($result['nb_voix'] / $result['nb_votants'])*100,2),
                "pourcentage_inscrit" => round(($result['nb_voix'] / $result['nb_inscrits'])*100,2),
                "nombre_voie" => $result['nb_voix']
            );            
        }

        $response = new JsonResponse();

        $response->setData(json_encode($r));
        return $response;

    }
}
