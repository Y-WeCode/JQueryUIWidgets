<?php

namespace YWC\JQueryUIWidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CGUType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => false,
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'label'  => $options['label'],
        ));
    }
    
    public function getParent()
    {
        return 'checkbox';
    }

    public function getName()
    {
        return 'jqui_cgu';
    }
}
