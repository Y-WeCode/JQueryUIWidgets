<?php

namespace YWC\JQueryUIWidgetsBundle\Form\DataTransformer;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;

class ArrayToStringTransformer implements DataTransformerInterface
{

    public function transform($issue)
    {
        if (null === $issue) return '';

        return implode(',', $issue);
    }

    public function reverseTransform($str)
    {
        if (!$str) return;
        
        return explode(',', $str);
    }
}