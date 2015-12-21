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

    /**
     * Transforms an ArrayCollection to a string (number list).
     *
     * @param  ArrayCollection $entities
     * @return string
     */
    public function transform($entities)
    {
        return $entities->toArray();
    }

    /**
     * Transforms a string (number list) to an ArrayCollection.
     *
     * @param  string $numbers
     * @return ArrayCollection
     * @throws TransformationFailedException if objects are not found.
     */
    public function reverseTransform($numbers)
    {
        return new ArrayCollection();        
    }
}