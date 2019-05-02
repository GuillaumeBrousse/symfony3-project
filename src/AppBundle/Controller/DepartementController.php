<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepartementController extends Controller
{


    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $dpt = $em->getRepository('AppBundle:Departement')->find($id);

        $globalResults = $em->getRepository('AppBundle:Candidat')->getDptResultats($dpt);

        $totalVotants = $em->getRepository('AppBundle:Mention')->getTotalVotantByDpt($dpt);
        $totalInscrits = $em->getRepository('AppBundle:Mention')->getTotalInscritByDpt($dpt);
        $globalResultsDpt = $em->getRepository('AppBundle:Resultat')->getResultatsDpt($dpt);
        


        return $this->render('::render/departements-show.html.twig', array(
        	'dpt' => $dpt,
            'globalResults' => $globalResults,
            'globalResultsDpt' => $globalResultsDpt,
            'totalVotants' => $totalVotants['nb_votants'],
            'totalInscrits' => $totalInscrits['nb_inscrits'],
        ));
        
    }

}
