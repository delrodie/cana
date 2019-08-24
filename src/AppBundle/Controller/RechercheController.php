<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RechercheController
 * @Route("/recherche")
 */
class RechercheController extends Controller
{
    /**
     * @Route("/", name="recherche")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $search = $request->get('search');
        $factures = $em->getRepository("AppBundle:Facture")->recherche($search);
        return $this->render('default/recherche.html.twig',[
            'factures' => $factures,
            'search' => $search,
            'current_menu' => 'dashboard'
        ]);
    }
}
