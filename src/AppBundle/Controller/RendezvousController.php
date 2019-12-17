<?php

namespace AppBundle\Controller;

use AppBundle\Utils\GestionPeniche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RendezvousController
 * @Route("/rendez-vous")
 */
class RendezvousController extends Controller
{
    /**
     * @Route("/", name="rdv_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository("AppBundle:Facture")->findLivraison();

        return $this->render('rdv/non_livre.html.twig',[
            'factures' => $factures,
            'current_menu' => 'livraison'
        ]);
    }

    /**
     * @Route("/valide", name="rdv_valide")
     * @Method({"GET","POST"})
     */
    public function valideAction(Request $request, GestionPeniche $gestionPeniche)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('factureID');
        if ($id){
            $facture = $em->getRepository("AppBundle:Facture")->findOneBy(['id'=>$id]); //dump($id);die();
            $facture->setLivraison(true);
            $em->flush();

            $gestionPeniche->deleteFlag($facture->getPeniche()->getId());
        }

        $factures = $em->getRepository("AppBundle:Facture")->findLivraison(true);

        return $this->render('rdv/livre.html.twig',[
            'factures' => $factures,
            'current_menu' => 'livraison'
        ]);
    }
}
