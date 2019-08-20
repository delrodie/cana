<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('AppBundle:Facture')->findBy(['statut'=>1],['id'=>'DESC']);
        $clientTotal = $em->getRepository("AppBundle:Client")->findNombre();
        $clientMois = $em->getRepository("AppBundle:Facture")->findNombreClient(); //dump($clientMois);die();

        return $this->render('default/index.html.twig', [
            'current_menu' => 'dashboard',
            'factures' => $factures,
            'clientTotal' => $clientTotal,
            'clientMois' => $clientMois
        ]);
    }
}
