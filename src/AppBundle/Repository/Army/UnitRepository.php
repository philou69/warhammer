<?php

namespace AppBundle\Repository\Army;

/**
 * UnitRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UnitRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRace($race)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->innerJoin('u.groupe', 'g')
            ->addSelect('g')
            ->where('u.race = :race')
            ->setParameter('race', $race)
            ->orderBy('u.name');

        return $qb;
    }
}