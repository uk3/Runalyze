<?php

namespace Runalyze\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class EnergyKcalType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['input_unit'] = 'kcal';
    }

    public function getParent()
    {
        return IntegerType::class;
    }
}
