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
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']); //dump($base);die();
        if ($facture) $facturation->impression($slug);
        return $this->render('default/facture.html.twig',[
            'facture' => $facture,
            'base' => $base
        ]);
    }

    /**
     * Fiche client
     *
     * @Route("/fiche-client/{slug}", name="pdf_fiche_client")
     * @Method("GET")
     */
    public function ficheclientAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('AppBundle:Facture')->findOneBy(array('slug'=>$slug));
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);

        return $this->render('default/imprim_ficheclient.html.twig',[
            'facture' => $facture,
            'base' => $base
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
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);
        //dump($factures);die();

        return $this->render('default/imprim_caisse.html.twig',[
            'factures' => $factures,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'base' => $base,
            'current_menu' => 'dashboard'
        ]);
    }

    /**
     * @Route("/{versement}", name="pdf_recu")
     * @Method("GET")
     */
    public function recuAction($versement)
    {
        $em= $this->getDoctrine()->getManager(); //dump($debut); dump($fin);
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);
        $versement = $em->getRepository("AppBundle:Versement")->findOneBy(['id'=>$versement]);
        return $this->render('default/imprim_recu.html.twig',[
            'versement' => $versement,
            'base' => $base,
        ]);
    }
}
