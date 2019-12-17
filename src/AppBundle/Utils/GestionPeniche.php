<?php


namespace AppBundle\Utils;


use Doctrine\ORM\EntityManager;

class GestionPeniche
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Activation du flag de la peniche
     * @param $id
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addFlag($id)
    {
        $peniche = $this->em->getRepository("AppBundle:Peniche")->findOneBy(['id'=>$id]);
        if ($peniche){
            $peniche->setFlag(true);
            $peniche->setNombreFacture($peniche->getNombreFacture()+1);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function deleteFlag($id)
    {
        $peniche = $this->em->getRepository("AppBundle:Peniche")->findOneBy(['id'=>$id]);
        if ($peniche){
            $peniche->setFlag(false);
            $this->em->flush();

            return true;
        }
        return false;
    }
}
