<?php

namespace YWC\JQueryUIWidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use YWC\JQueryUIWidgetsBundle\Utils\EntityToIntegerTransformerFactory;

class Select2Type extends AbstractType
{

    private $transformerFactory;
    
    public function __construct(EntityToIntegerTransformerFactory $transformerFactory)
    {
        $this->transformerFactory = $transformerFactory;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'autocomplete' => null,
            'classname' => null,
            'multiple' => false,
        ));
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(!empty($options['classname'])) {
            $builder->addModelTransformer($this->transformerFactory->create($options['classname'], $options['multiple'], 'select2'));
        }
    }
    

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if(is_null($options['autocomplete'])) {
            throw new LogicException('Autocomplete field option "autocomplete" cannot be null.');
        }        

        $view->vars = array_replace($view->vars, array(
            'autocomplete'  => $options['autocomplete'],
            'multiple' => $options['multiple'],
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'select2';
    }
}
