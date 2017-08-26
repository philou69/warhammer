<?php

namespace AppBundle\Repository\Unit;

/**
 * OptionsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EquipementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRace($race)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->innerJoin('e.units', 'u')
            ->addSelect('u')
            ->where('u.race = :race')
            ->setParameter('race', $race);

        return $qb;
    }
    public function findByUnit($unit)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->innerJoin('e.units', 'u')
            ->where('u.id = :unit')
            ->setParameter('unit', $unit->getId());

        return $qb;
    }

    public function findByFigurine($figurine)
    {
        $queryBuilder = $this->createQueryBuilder('e');
        $queryBuilder->where('e.figurine = :figurine')
            ->setParameter('figurine', $figurine)
            ->orderBy('e.name', 'ASC');
        return $queryBuilder;
    }
}