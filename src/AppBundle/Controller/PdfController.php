<?php

namespace AppBundle\Controller;

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
    public function indexAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('AppBundle:Facture')->findOneBy(array('slug'=>$slug));
        return $this->render('default/facture.html.twig',[
            'facture' => $facture
        ]);
    }
}
