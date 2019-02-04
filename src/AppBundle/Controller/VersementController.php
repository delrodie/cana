<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Versement;
use AppBundle\Utils\Facturation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Versement controller.
 *
 * @Route("versement")
 */
class VersementController extends Controller
{
    /**
     * Lists all versement entities.
     *
     * @Route("/", name="versement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $versements = $em->getRepository('AppBundle:Versement')->findByFacture();

        return $this->render('versement/index.html.twig', array(
            'versements' => $versements,
            'current_menu' => 'facture'
        ));
    }

    /**
     * Creates a new versement entity.
     *
     * @Route("/new/{facture}", name="versement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $facture, Facturation $facturation)
    {
        $versement = new Versement(); //dump($facture);die();
        $form = $this->createForm('AppBundle\Form\VersementType', $versement, ['facture'=> $facture]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $facture_rap = $request->get('facture_rap'); $versement->setMontant($facture_rap);
            $rap = $request->get('rap'); $versement->setReste($rap);
            $acompte = $request->get('acompte'); $versement->setAcompte($acompte);
            $versement->setStatut(true);
            //dump($facture);die();
            $em->persist($versement);
            $em->flush();

            $reduction = $facturation->reduction($facture, $rap);
            if ($reduction){
                return $this->redirectToRoute('versement_show', ['facture' => $facture]);
            }else{
                return $this->redirectToRoute('versement_index');
            }
        }
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('AppBundle:Facture')->findOneBy(array('slug'=>$facture));

        return $this->render('versement/new.html.twig', array(
            'versement' => $versement,
            'form' => $form->createView(),
            'current_menu' => 'facture',
            'facture' => $factures,
        ));
    }

    /**
     * Finds and displays a versement entity.
     *
     * @Route("/{facture}", name="versement_show")
     * @Method("GET")
     */
    public function showAction($facture)
    {
        $em = $this->getDoctrine()->getManager();


        $versements = $em->getRepository('AppBundle:Versement')->findByFacture($facture); //dump($versements);die();

        return $this->render('versement/show.html.twig', array(
            'versements' => $versements,
            'current_menu' => 'facture'
        ));
    }

    /**
     * Displays a form to edit an existing versement entity.
     *
     * @Route("/{id}/edit", name="versement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Versement $versement)
    {
        $deleteForm = $this->createDeleteForm($versement);
        $editForm = $this->createForm('AppBundle\Form\VersementType', $versement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('versement_edit', array('id' => $versement->getId()));
        }

        return $this->render('versement/edit.html.twig', array(
            'versement' => $versement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a versement entity.
     *
     * @Route("/{id}", name="versement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Versement $versement)
    {
        $form = $this->createDeleteForm($versement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($versement);
            $em->flush();
        }

        return $this->redirectToRoute('versement_index');
    }

    /**
     * Creates a form to delete a versement entity.
     *
     * @param Versement $versement The versement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Versement $versement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('versement_delete', array('id' => $versement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
