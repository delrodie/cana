<?php
/**
 * User: AMOIKON DELRODIE
 * Date: 07/01/2019
 * Time: 23:49
 */

namespace AppBundle\Utils;


use AppBundle\Entity\Versement;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Facturation
{
    public function __construct(ContainerInterface $container,EntityManager $entityManager)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    /**
     * Generation du code de la facture
     *
     * @return $code
     */
    public function code()
    {
        //Recuperation du numero de la facture
        $numero = $this->em->getRepository('AppBundle:Facture')->getFactureNumber();

        // Recuperation de la date du jour
        $date = date('ym', time());

        //Affectation du code
        return $code = 'F'.$date.'-'.$numero;
    }

    /**
     * Encaissement de
     */
    public function encaissement($facture = null, $versment = null)
    {
        // Si facture transmise alors initialisation de la caisse
        // sinon mise a jour du versement
        if ($facture){
            $versement = new Versement();
            $facture = $this->em->getRepository('AppBundle:Facture')->findOneBy(array('id'=>$facture));
            $versement->setFacture($facture);
            $versement->setMontant($facture->getMontantTTC());
            $versement->setAcompte($facture->getAcompte());
            $versement->setReste($facture->getRap());
            $versement->setStatut(1);
            $this->em->persist($versement);
            $this->em->flush();//dump($facture);die();

            return true;
        }else{
            return $message = "Pas encore traité";
        }
    }


}