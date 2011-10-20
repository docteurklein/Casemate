<?php

namespace Knp\Bundle\StaticBlockBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\Form\BlockFormType;

class StaticBlockFormType extends BlockFormType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('content', 'textarea'); // TODO: rich text box
    }

    public function getName()
    {
        return 'static_block';
    }
}
