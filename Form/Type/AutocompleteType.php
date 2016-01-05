<?php

namespace YWC\JQueryUIWidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use YWC\JQueryUIWidgetsBundle\Utils\DataTransformerFactory;

class AutocompleteType extends AbstractType
{

    private $transformerFactory;
    
    public function __construct(DataTransformerFactory $transformerFactory)
    {
        $this->transformerFactory = $transformerFactory;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'ywc_autocomplete_type' => null,
            'text_value' => null,
            'classname' => null,
            'multiple' => false,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(!empty($options['classname'])) {
            $builder->addModelTransformer($this->transformerFactory->create($options['classname'], $options['multiple']));
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if(is_null($options['ywc_autocomplete_type'])) {
            throw new LogicException('Autocomplete field option "ywc_autocomplete_type" cannot be null.');
        }        

        $view->vars = array_replace($view->vars, array(
            'ywc_autocomplete_type'  => $options['ywc_autocomplete_type'],
            'text_value' => $options['text_value'],
            'multiple' => $options['multiple'],
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'jqui_autocomplete';
    }
}
