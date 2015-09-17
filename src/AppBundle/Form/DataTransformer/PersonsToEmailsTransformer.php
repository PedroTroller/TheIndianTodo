<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

class PersonsToEmailsTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        $result = "";
        foreach ($value as $person) {
            if (false === empty($person->getEmail())) {
                $result = sprintf("%s\n%s", $result, $person->getEmail());
            }
        }

        return $result;
    }

    public function reverseTransform($value)
    {
        $emails  = explode("\n", $value);
        $persons = [];

        foreach ($emails as $email) {
            $persons[] = (new Person())->setEmail($email);
        }

        return new ArrayCollection($persons);
    }
}
