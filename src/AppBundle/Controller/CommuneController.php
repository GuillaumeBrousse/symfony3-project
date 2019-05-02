<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommuneController extends Controller
{

    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $commune = $em->getRepository('AppBundle:Commune')->find($id);

        $globalResults = $em->getRepository('AppBundle:Candidat')->getCommuneResultats($commune);

        $totalVotants = $em->getRepository('AppBundle:Mention')->getTotalVotantByCommune($commune);
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getTotalInscritByCommune($commune);
        $globalResultsCommune = $em->getRepository('AppBundle:Resultat')->getResultatsCommune($commune);
        


        return $this->render('::render/communes-show.html.twig', array(
        	'commune' => $commune,
            'globalResults' => $globalResults,
            'globalResultsCommune' => $globalResultsCommune,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
        
    }
}
