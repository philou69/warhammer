<?php

namespace AppBundle\Repository\Battle;

/**
 * ParticipantRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParticipantRepository extends \Doctrine\ORM\EntityRepository
{
    public function findWithoutVisitor($battle, $user)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.battle = :battle')
            ->setParameter('battle', $battle)
            ->andWhere('p.participant != :participant')
            ->setParameter('participant', $user);

        return $qb->getQuery()->getResult();
    }
}
