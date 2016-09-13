<?php

namespace AppBundle\Repository\Army;

/**
 * FigurineRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FigurineRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRace($race)
    {
        $qb = $this->createQueryBuilder('f');

        $qb->innerJoin('f.groupe', 'g')
            ->addSelect('g')
            ->where('f.race = :race')
            ->setParameter('race', $race)
            ->orderBy('f.name');

        return $qb;
    }
}
