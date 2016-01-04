<?php

namespace YWC\JQueryUIWidgetsBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArrayCollectionToArrayTransformer implements DataTransformerInterface
{
    private $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function transform($entities)
    {
        return $entities->toArray();
    }

    public function reverseTransform($numbers)
    {
        return new ArrayCollection(array_map(function($id) {
            return $this->repository->find($id);
        }, $numbers));        
    }
}