<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Monture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Monture controller.
 *
 * @Route("monture")
 */
class MontureController extends Controller
{
    /**
     * Lists all monture entities.
     *
     * @Route("/", name="monture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $montures = $em->getRepository('AppBundle:Monture')->findAll();

        return $this->render('monture/index.html.twig', array(
            'montures' => $montures,
            'current_menu' => 'monture'
        ));
    }

    /**
     * Creates a new monture entity.
     *
     * @Route("/new", name="monture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $monture = new Monture();
        $form = $this->createForm('AppBundle\Form\MontureType', $monture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monture);
            $em->flush();

            $this->addFlash('notice', 'La monture '.$monture->getMarque()->getLibelle().' : '.$monture->getReference().' a été enregistrée avec succès');

            return $this->redirectToRoute('monture_new');
        }

        return $this->render('monture/new.html.twig', array(
            'monture' => $monture,
            'form' => $form->createView(),
            'current_menu' => 'monture'
        ));
    }

    /**
     * Finds and displays a monture entity.
     *
     * @Route("/{id}", name="monture_show")
     * @Method("GET")
     */
    public function showAction(Monture $monture)
    {
        $deleteForm = $this->createDeleteForm($monture);

        return $this->render('monture/show.html.twig', array(
            'monture' => $monture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing monture entity.
     *
     * @Route("/{slug}/edit", name="monture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Monture $monture)
    {
        $deleteForm = $this->createDeleteForm($monture);
        $editForm = $this->createForm('AppBundle\Form\MontureType', $monture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'La monture '.$monture->getMarque()->getLibelle().' : '.$monture->getReference().' a été modifée avec succès');

            return $this->redirectToRoute('monture_index');
        }

        return $this->render('monture/edit.html.twig', array(
            'monture' => $monture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'monture'
        ));
    }

    /**
     * Deletes a monture entity.
     *
     * @Route("/{id}", name="monture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Monture $monture)
    {
        $form = $this->createDeleteForm($monture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($monture);
            $em->flush();
        }

        return $this->redirectToRoute('monture_index');
    }

    /**
     * Creates a form to delete a monture entity.
     *
     * @param Monture $monture The monture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Monture $monture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('monture_delete', array('id' => $monture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
