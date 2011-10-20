<?php

namespace Knp\Bundle\BlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 *
 * BlockFormType is the Type used by FormFactory to build a generic Block edition Form
 * It is normally extended by *BlockFormType
 *
 * @author fklein
 */
abstract class BlockFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('frontendControllerId', 'text', array('required' => false))
        ;
    }
}
