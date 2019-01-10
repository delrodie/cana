<?php
/**
 * User: AMOIKON DELRODIE
 * Date: 10/01/2019
 * Time: 01:02
 */

namespace AppBundle\Utils;


use AppBundle\Entity\Monture;
use Doctrine\ORM\EntityManager;

class Inventaire
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Sortie de stock de la facture
     */
    public function destockage($id)
    {
        $monture = $this->em->getRepository('AppBundle:Monture')->findOneBy(array('id'=>$id)); //dump($monture);die();
        $stock = $monture->getStock() - 1;
        $monture->setStock($stock);
        $this->em->persist($monture);
        $this->em->flush();

        if($stock === $monture->getStock()){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Approvisionnement du stock
     */
    public function approvisionnement($id)
    {
        $monture = $this->em->getRepository('AppBundle:Monture')->findOneBy(array('id'=>$id));
        $stock = $monture->getStock() + 1;
        $monture->setStock($stock);
        $this->em->persist($monture);
        $this->em->flush();

        if ($stock === $monture->getStock()){
            return true;
        } else{
            return false;
        }
    }

}