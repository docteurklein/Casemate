<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\Form\BlockFormType;

class DoctrineProviderBlockFormType extends BlockFormType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('className');
    }

    public function getName()
    {
        return 'doctrine_provider_block';
    }
}
