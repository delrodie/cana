<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("client")
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AppBundle:Client')->findList(); //dump($clients); die();

        return $this->render('client/index.html.twig', array(
            'clients' => $clients,
            'current_menu' => 'client'
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('AppBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client->setStatut(1);
            $em->persist($client);
            $em->flush();

            $this->addFlash('notice', 'Le client '.$client->getNom().' '.$client->getPrenoms().' a été ajouté avec succès');

            return $this->redirectToRoute('client_show', array('slug' => $client->getSlug()));
        }

        return $this->render('client/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
            'current_menu' => 'client'
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{slug}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($client);

        $factures = $em->getRepository("AppBundle:Facture")->findBy(['client'=>$client->getId()], ['id'=>'DESC']);

        return $this->render('client/show.html.twig', array(
            'client' => $client,
            'factures' => $factures,
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'client'
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{slug}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('AppBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Le client '.$client->getNom().' '.$client->getPrenoms().' a été modifié avec succès');

            return $this->redirectToRoute('client_show', array('slug' => $client->getSlug()));
        }

        return $this->render('client/edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'client'
        ));
    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
