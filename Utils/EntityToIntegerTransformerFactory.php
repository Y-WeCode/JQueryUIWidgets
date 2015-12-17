<?php

namespace YWC\JQueryUIWidgetsBundle\Utils;

use Doctrine\ORM\EntityManager;
use YWC\JQueryUIWidgetsBundle\Form\DataTransformer\EntityToIntegerTransformer;

class EntityToIntegerTransformerFactory
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($classname)
    {
        return new EntityToIntegerTransformer($this->em->getRepository($classname));
    }
}