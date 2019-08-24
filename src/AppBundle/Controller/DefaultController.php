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
        $clientMois = $em->getRepository("AppBundle:Facture")->findNombreClient();
        $montureNombre = $em->getRepository("AppBundle:Monture")->findNombre(1);//dump($montureNombre);die();
        $montureEpuisee = $em->getRepository("AppBundle:Monture")->findNombre();//dump($montureNombre);die();
        $factureSoldee = $em->getRepository("AppBundle:Facture")->findNombreFacture(1);
        $factureNonSoldee = $em->getRepository("AppBundle:Facture")->findNombreFacture();

        return $this->render('default/index.html.twig', [
            'current_menu' => 'dashboard',
            'factures' => $factures,
            'clientTotal' => $clientTotal,
            'clientMois' => $clientMois,
            'nombre_monture' => $montureNombre,
            'monture_epuise' => $montureEpuisee,
            'facture_solde' => $factureSoldee,
            'facture_non_solde' => $factureNonSoldee,
        ]);
    }

}
