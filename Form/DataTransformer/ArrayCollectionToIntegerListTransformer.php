<?php

namespace YWC\JQueryUIWidgetsBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArrayCollectionToIntegerListTransformer implements DataTransformerInterface
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
        return $entities;
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
        $result = new ArrayCollection();
        $numbers = explode(',', $numbers);
        foreach($numbers as $number) {
            if(!$number) continue;
            $entity = $this->repository->find($number);
            if (is_null($entity)) {
                throw new TransformationFailedException(sprintf(
                    'An entity with number "%s" does not exist!',
                    $number
                ));
            }
            $result->add($entity);
        }

        return $result;
    }
}