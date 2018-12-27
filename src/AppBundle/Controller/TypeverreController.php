<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Typeverre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeverre controller.
 *
 * @Route("typeverre")
 */
class TypeverreController extends Controller
{
    /**
     * Lists all typeverre entities.
     *
     * @Route("/", name="typeverre_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $typeverre = new Typeverre();
        $form = $this->createForm('AppBundle\Form\TypeverreType', $typeverre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeverre);
            $em->flush();

            return $this->redirectToRoute('typeverre_index');
        }

        $typeverres = $em->getRepository('AppBundle:Typeverre')->findAll();

        return $this->render('typeverre/index.html.twig', array(
            'typeverres' => $typeverres,
            'typeverre' => $typeverre,
            'form' => $form->createView(),
            'current_menu' => 'verre'
        ));
    }

    /**
     * Creates a new typeverre entity.
     *
     * @Route("/new", name="typeverre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeverre = new Typeverre();
        $form = $this->createForm('AppBundle\Form\TypeverreType', $typeverre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeverre);
            $em->flush();

            return $this->redirectToRoute('typeverre_show', array('id' => $typeverre->getId()));
        }

        return $this->render('typeverre/new.html.twig', array(
            'typeverre' => $typeverre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeverre entity.
     *
     * @Route("/{id}", name="typeverre_show")
     * @Method("GET")
     */
    public function showAction(Typeverre $typeverre)
    {
        $deleteForm = $this->createDeleteForm($typeverre);

        return $this->render('typeverre/show.html.twig', array(
            'typeverre' => $typeverre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeverre entity.
     *
     * @Route("/{slug}/edit", name="typeverre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Typeverre $typeverre)
    {
        $deleteForm = $this->createDeleteForm($typeverre);
        $editForm = $this->createForm('AppBundle\Form\TypeverreType', $typeverre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeverre_index');
        }

        $typeverres = $this->getDoctrine()->getManager()->getRepository('AppBundle:Typeverre')->findAll();

        return $this->render('typeverre/edit.html.twig', array(
            'typeverre' => $typeverre,
            'typeverres' => $typeverres,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'verre'
        ));
    }

    /**
     * Deletes a typeverre entity.
     *
     * @Route("/{id}", name="typeverre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Typeverre $typeverre)
    {
        $form = $this->createDeleteForm($typeverre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeverre);
            $em->flush();
        }

        return $this->redirectToRoute('typeverre_index');
    }

    /**
     * Creates a form to delete a typeverre entity.
     *
     * @param Typeverre $typeverre The typeverre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Typeverre $typeverre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeverre_delete', array('id' => $typeverre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
