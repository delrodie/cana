<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Facture;
use AppBundle\Utils\Facturation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Facture controller.
 *
 * @Route("facture")
 */
class FactureController extends Controller
{
    /**
     * Lists all facture entities.
     *
     * @Route("/", name="facture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $factures = $em->getRepository('AppBundle:Facture')->findList();

        return $this->render('facture/index.html.twig', array(
            'factures' => $factures,
            'current_menu' => 'facture'
        ));
    }

    /**
     * Creates a new facture entity.
     *
     * @Route("/new", name="facture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Facturation $facturation)
    {
        $facture = new Facture();
        $form = $this->createForm('AppBundle\Form\FactureType', $facture);
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
            $em->persist($facture);
            $em->flush();

            return $this->redirectToRoute('facture_show', array('slug' => $facture->getSlug()));
        }

        return $this->render('facture/new.html.twig', array(
            'facture' => $facture,
            'form' => $form->createView(),
            'current_menu' => 'facture'
        ));
    }

    /**
     * Finds and displays a facture entity.
     *
     * @Route("/{slug}", name="facture_show")
     * @Method("GET")
     */
    public function showAction(Facture $facture)
    {
        $deleteForm = $this->createDeleteForm($facture);

        return $this->render('facture/show.html.twig', array(
            'facture' => $facture,
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'facture'
        ));
    }

    /**
     * Displays a form to edit an existing facture entity.
     *
     * @Route("/{id}/edit", name="facture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Facture $facture, Facturation $facturation)
    {
        $deleteForm = $this->createDeleteForm($facture);
        $editForm = $this->createForm('AppBundle\Form\FactureType', $facture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
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
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facture_show', array('slug' => $facture->getSlug()));
        }
/**
        <select id="appbundle_facture_odSph" name="appbundle_facture[odSph]" class="form-control" placeholder="selectionnez le client">
        {% for i in range(low=-10.00, high=10.00, step=0.25)  %}
            <option value="{{ i }}">{{ i }}</option>
        {% endfor %}
    </select>*/

        return $this->render('facture/edit.html.twig', array(
            'facture' => $facture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'current_menu' => 'facture'
        ));
    }

    /**
     * Deletes a facture entity.
     *
     * @Route("/{id}", name="facture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Facture $facture)
    {
        $form = $this->createDeleteForm($facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($facture);
            $em->flush();
        }

        return $this->redirectToRoute('facture_index');
    }

    /**
     * Creates a form to delete a facture entity.
     *
     * @param Facture $facture The facture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Facture $facture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facture_delete', array('id' => $facture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
