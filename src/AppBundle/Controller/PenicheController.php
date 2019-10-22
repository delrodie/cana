<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Peniche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Peniche controller.
 *
 * @Route("peniche")
 */
class PenicheController extends Controller
{
    /**
     * Lists all peniche entities.
     *
     * @Route("/", name="peniche_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $peniches = $em->getRepository('AppBundle:Peniche')->findAll();
        $peniche = new Peniche();
        $form = $this->createForm('AppBundle\Form\PenicheType', $peniche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peniche);
            $em->flush();

            return $this->redirectToRoute('peniche_index');
        }

        return $this->render('peniche/index.html.twig', array(
            'peniches' => $peniches,
            'peniche' => $peniche,
            'form' => $form->createView(),
            'current_menu' => 'parametre'
        ));
    }

    /**
     * Creates a new peniche entity.
     *
     * @Route("/new", name="peniche_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $peniche = new Peniche();
        $form = $this->createForm('AppBundle\Form\PenicheType', $peniche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peniche);
            $em->flush();

            return $this->redirectToRoute('peniche_show', array('id' => $peniche->getId()));
        }

        return $this->render('peniche/new.html.twig', array(
            'peniche' => $peniche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a peniche entity.
     *
     * @Route("/{id}", name="peniche_show")
     * @Method("GET")
     */
    public function showAction(Peniche $peniche)
    {
        $deleteForm = $this->createDeleteForm($peniche);

        return $this->render('peniche/show.html.twig', array(
            'peniche' => $peniche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing peniche entity.
     *
     * @Route("/{slug}/edit", name="peniche_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Peniche $peniche)
    {
        $em = $this->getDoctrine()->getManager();

        $peniches = $em->getRepository('AppBundle:Peniche')->findAll();

        $deleteForm = $this->createDeleteForm($peniche);
        $editForm = $this->createForm('AppBundle\Form\PenicheType', $peniche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peniche_index');
        }

        return $this->render('peniche/edit.html.twig', array(
            'peniche' => $peniche,
            'peniches' => $peniches,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'parametre'
        ));
    }

    /**
     * Deletes a peniche entity.
     *
     * @Route("/{id}", name="peniche_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Peniche $peniche)
    {
        $form = $this->createDeleteForm($peniche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($peniche);
            $em->flush();
        }

        return $this->redirectToRoute('peniche_index');
    }

    /**
     * Creates a form to delete a peniche entity.
     *
     * @param Peniche $peniche The peniche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Peniche $peniche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peniche_delete', array('id' => $peniche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
