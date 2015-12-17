<?php

namespace YWC\JQueryUIWidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatePickerType extends AbstractType
{

    public function __construct($locale = null)
    {
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
        ));
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'jqui_datepicker';
    }
}
