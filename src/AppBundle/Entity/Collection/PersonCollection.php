<?php

namespace AppBundle\Entity\Collection;

use Doctrine\Common\Collections\Criteria;

class PersonCollection extends AbstractCollection
{
    public function thatHasFirstname()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->neq("firstname", null))
            ->andWhere(Criteria::expr()->neq("firstname", ""))
        ;

        return $this->matching($criteria);
    }

    public function thatHasLastname()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->neq("lastname", null))
            ->andWhere(Criteria::expr()->neq("lastname", ""))
        ;

        return $this->matching($criteria);
    }
}
