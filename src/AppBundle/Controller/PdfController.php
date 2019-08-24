<?php

namespace AppBundle\Controller;

use AppBundle\Utils\Facturation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PdfController
 * @Route("/pdf")
 */
class PdfController extends Controller
{
    /**
     * @Route("/facture-{slug}", name="pdf_facture")
     * @Method("GET")
     */
    public function indexAction($slug, Facturation $facturation)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('AppBundle:Facture')->findOneBy(array('slug'=>$slug));
        if ($facture) $facturation->impression($slug);
        return $this->render('default/facture.html.twig',[
            'facture' => $facture
        ]);
    }

    /**
     * @Route("/caisse/{debut}/{fin}", name="pdf_caisse")
     * @Method("GET")
     */
    public function caisseAction($debut,$fin)
    {
        $em= $this->getDoctrine()->getManager(); //dump($debut); dump($fin);
        $factures = $em->getRepository("AppBundle:Facture")->findCaissePeriode($debut,$fin);
        //dump($factures);die();

        return $this->render('default/imprim_caisse.html.twig',[
            'factures' => $factures,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'current_menu' => 'dashboard'
        ]);
    }
}
