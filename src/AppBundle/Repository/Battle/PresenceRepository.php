<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 05/09/16
 * Time: 15:52
 */

namespace AppBundle\Repository\Battle;


class PresenceRepository extends  \Doctrine\ORM\EntityManager
{
    public function findWithoutNonRepondu()
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.id != 4');

        return $qb;
    }
}