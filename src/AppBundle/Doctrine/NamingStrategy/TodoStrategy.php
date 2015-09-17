<?php

namespace AppBundle\Doctrine\NamingStrategy;

use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

class TodoStrategy extends UnderscoreNamingStrategy
{
    public function classToTableName($class)
    {
        return sprintf('todo_%s', parent::classToTableName($class));
    }

    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null)
    {
        return sprintf('%s_relation', parent::joinTableName($sourceEntity, $targetEntity, $propertyName));
    }

    public function joinColumnName($propertyName, $className = null)
    {
        return $propertyName . '_key';
    }
}
