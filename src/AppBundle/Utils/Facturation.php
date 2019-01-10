<?php
/**
 * User: AMOIKON DELRODIE
 * Date: 07/01/2019
 * Time: 23:49
 */

namespace AppBundle\Utils;


use Doctrine\ORM\EntityManager;
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

}