<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegionController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $totalVotants = $em->getRepository('AppBundle:Mention')->getGlobalTotalVotant();
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getGlobalTotalInscrit();

        $globalResults = $em->getRepository('AppBundle:Candidat')->getGlobalResultats();
        $globalResultsRegions = $em->getRepository('AppBundle:Resultat')->getGlobalResultatsRegion();
            

        return $this->render('::render/regions.html.twig', array(
            'globalResults' => $globalResults,
            'globalResultsRegions' => $globalResultsRegions,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
    }


    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $region = $em->getRepository('AppBundle:Region')->find($id);

        $globalResults = $em->getRepository('AppBundle:Candidat')->getRegionResultats($region);

        $totalVotants = $em->getRepository('AppBundle:Mention')->getTotalVotantByRegion($region);
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getTotalInscritByRegion($region);
        $globalResultsRegion = $em->getRepository('AppBundle:Resultat')->getResultatsRegion($region);

        return $this->render('::render/regions-show.html.twig', array(
            'region' => $region,
            'globalResults' => $globalResults,
            'globalResultsRegion' => $globalResultsRegion,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
        
    }
}
