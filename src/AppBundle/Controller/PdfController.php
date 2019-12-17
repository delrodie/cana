<?php

namespace AppBundle\Controller;

use AppBundle\Utils\Facturation;
use AppBundle\Utils\GestionLettre;
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
    public function indexAction($slug, Facturation $facturation, GestionLettre $gestionLettre)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('AppBundle:Facture')->findOneBy(array('slug'=>$slug));
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']); //dump($base);die();
        if ($facture) $facturation->impression($slug);
        $montantLettre = $gestionLettre->nombre_en_lettre($facture->getMontantTTC());
        return $this->render('default/facture.html.twig',[
            'facture' => $facture,
            'base' => $base,
            'montant_lettre' =>$montantLettre,
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
    public function recuAction($versement, GestionLettre $gestionLettre)
    {
        $em= $this->getDoctrine()->getManager(); //dump($debut); dump($fin);
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);
        $versement = $em->getRepository("AppBundle:Versement")->findOneBy(['id'=>$versement]);
        $montantLettre = $gestionLettre->nombre_en_lettre($versement->getAcompte());

        return $this->render('default/imprim_recu.html.twig',[
            'versement' => $versement,
            'base' => $base,
            'montant_lettre' => $montantLettre,
        ]);
    }

    /**
     * @Route("/{assuranceID}/{debut}/{fin}", name="pdf_assurance")
     * @Method("GET")
     */
    public function assuranceAction($assuranceID,$debut,$fin)
    {
        $em= $this->getDoctrine()->getManager(); //dump($debut); dump($fin);
        $factures = $em->getRepository("AppBundle:Facture")->findByAssurance($assuranceID,$debut,$fin);
        $base = $em->getRepository("AppBundle:Base")->findOneBy(['statut'=>1], ['id'=>'DESC']);
        $assurance = $em->getRepository("AppBundle:Assurance")->findOneBy(['slug'=>$assuranceID]);
        //dump($factures);die();

        return $this->render('default/imprim_assurance.html.twig',[
            'factures' => $factures,
            'assurance' => $assurance,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'base' => $base,
            'current_menu' => 'dashboard'
        ]);
    }
}
