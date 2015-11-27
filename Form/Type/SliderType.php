<?php

namespace YWC\Common\JQueryUIWidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'ywc_max' => 100,
            'ywc_min' => 0,
            'empty_data' => 0,
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'ywc_max'  => $options['ywc_max'],
            'ywc_min'  => $options['ywc_min'],
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'jqui-slider';
    }
}
