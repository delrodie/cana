<?php

namespace AppBundle\Repository;

/**
 * AssuranceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssuranceRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     *  Liste des assurances
     */
    public function findList($statut = null)
    {
        return $this->createQueryBuilder('a')
                    ->where('a.statut = :stat')
                    ->orderBy('a.libelle', 'ASC')
                    ->setParameter('stat', $statut)
            ;
    }
}
