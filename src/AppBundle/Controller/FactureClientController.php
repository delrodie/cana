<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Facture;
use AppBundle\Utils\Facturation;
use AppBundle\Utils\Inventaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FactureClientController
 * @Route("/facturaction")
 */
class FactureClientController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/new/{client}", name="facturation_new")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request, Facturation $facturation, Inventaire $inventaire, $client)
    {
        $facture = new Facture();
        $form = $this->createForm('AppBundle\Form\FacturationType', $facture, ['client'=>$client]);
        $form->handleRequest($request); //dump($facturation->code());die();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); //dump($facture);die('ici');
            // Generation du code de la facture
            $facture->setOdSph($request->get('odSph')); $facture->setOdCyl($request->get('odCyl'));
            $facture->setOdAdd($request->get('odAdd')); $facture->setOdAxe($request->get('odAxe'));
            $facture->setOgSph($request->get('ogSph')); $facture->setOgCyl($request->get('ogCyl'));
            $facture->setOgAdd($request->get('ogAdd')); $facture->setOgAxe($request->get('ogAxe'));
            // Elimination des espace et point dans les montants saisis
            //$mt = $facture->getMontantHT(); $mtt = $facture->getMontantTTC(); $rap = $facture->getRap();
            $mth = $request->get('mtHT'); $facture->setMontantHT($mth);
            $mtc = $request->get('mtTTC'); $facture->setMontantTTC($mtc);
            $rap = $request->get('RAP'); $facture->setRap($rap);
            $assurance = $request->get('Assurance'); $facture->setPartAssurance($assurance);
            $accompte = $request->get('Accompte'); $facture->setAcompte($accompte);
            $code = $facturation->code();
            $facture->setNumero($code); //dump($facture);die();
            $facture->setStatut(1);
            $em->persist($facture);
            $em->flush();

            $inventaire->destockage($facture->getMonture()->getId());
            $facturation->encaissement($facture->getId());

            return $this->redirectToRoute('facture_show', array('slug' => $facture->getSlug()));
        }

        return $this->render('facture/new.html.twig', array(
            'facture' => $facture,
            'form' => $form->createView(),
            'current_menu' => 'facture'
        ));
    }
}
