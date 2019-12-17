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

    /**
     * point caisse selon la periode
     *
     * @Route("/caisse", name="recherche_caisse")
     * @Method({"GET","POST"})
     */
    public function caisseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $debut = $request->get('date_debut'); //dump($debut);die();
        $fin = $request->get('date_fin');

        $factures = $em->getRepository("AppBundle:Facture")->findCaissePeriode($debut,$fin); //dump($factures);die();
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);

        return $this->render('default/caisse.html.twig',[
            'factures' => $factures,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'base' => $base,
            'current_menu' => 'dashboard'
        ]);
    }

    /**
     * @Route("/assurance/", name="recherche_assurance_index")
     * @Method({"GET","POST"})
     */
    public function assuranceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $assuranceSearch = $request->get('assurance'); //dump($assuranceSearch);die();
        $debut = $request->get('date_debut');
        $fin = $request->get('date_fin');

        $factures = $em->getRepository("AppBundle:Facture")->findCaissePeriode($debut,$fin);
        $assurances = $em->getRepository("AppBundle:Assurance")->findAll();

        return $this->render("default/assurance.html.twig",[
            'factures' => $factures,
            'assurances' => $assurances,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'current_menu' => 'dashboard',
        ]);
    }

    /**
     * @Route("/assurance/recherche", name="recherche_assurance_show")
     * @Method({"GET","POST"})
     */
    public function assuranceShowction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $assuranceSearch = $request->get('assurance');
        $debut = $request->get('date_debut');
        $fin = $request->get('date_fin'); //dump($assuranceSearch);die();

        $factures = $em->getRepository("AppBundle:Facture")->findByAssurance($assuranceSearch,$debut,$fin); //dump($assuranceSearch);die();
        $assurances = $em->getRepository("AppBundle:Assurance")->findAll();
        if ($assuranceSearch) $assurance = $em->getRepository("AppBundle:Assurance")->findOneBy(['slug'=>$assuranceSearch]); //dump($assurance);die();

        return $this->render("default/assurance_show.html.twig",[
            'factures' => $factures,
            'assurances' => $assurances,
            'assurance' => $assurance,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'current_menu' => 'dashboard',
        ]);
    }
}
