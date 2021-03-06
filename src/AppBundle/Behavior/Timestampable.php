<?php

namespace AppBundle\Behavior;

interface Timestampable
{
    public function getCreatedAt();

    public function setCreatedAt(\DateTime $createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt(\DateTime $updatedAt);
}
