<?php

namespace AppBundle\Repository\Battle;

class PresenceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findWithoutNonRepondu()
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.id != 4');

        return $qb;
    }

    public function findCombat()
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.id = 3');

        return $qb;
    }
}
