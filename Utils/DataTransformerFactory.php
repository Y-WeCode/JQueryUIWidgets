<?php

namespace YWC\JQueryUIWidgetsBundle\Utils;

use Doctrine\ORM\EntityManager;
use YWC\JQueryUIWidgetsBundle\Form\DataTransformer\ArrayCollectionToArrayTransformer;
use YWC\JQueryUIWidgetsBundle\Form\DataTransformer\ArrayCollectionToIntegerListTransformer;
use YWC\JQueryUIWidgetsBundle\Form\DataTransformer\EntityToIntegerTransformer;

class DataTransformerFactory
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($classname, $multiple = false, $widget = 'jqui_autocomplete')
    {
        if($widget === 'select2') {
            return new ArrayCollectionToArrayTransformer($this->em->getRepository($classname));
        }        
        
        if($multiple) return new ArrayCollectionToIntegerListTransformer($this->em->getRepository($classname));
        else return new EntityToIntegerTransformer($this->em->getRepository($classname));
    }
}