<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function createQueryBuilder($alias, $index = null)
    {
        return parent::createQueryBuilder($alias, $index)
            ->leftJoin('t.creator', 'c')
            ->leftJoin('t.owner', 'o')
            ->leftJoin('t.persons', 'p')
            ->addSelect('c, o, p')
        ;
    }

    public function findAll()
    {
        return $this
            ->createQueryBuilder('t')
            ->getQuery()
            ->getResult()
        ;
    }
}
