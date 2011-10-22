<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\Form\BlockFormType;

class DoctrineProviderBlockFormType extends BlockFormType
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('className', 'choice', array(
            'choices' => $this->getClassNames()
        ));
        $builder->add('listTemplate');
        $builder->add('viewTemplate');
    }

    private function getClassNames()
    {
        $choices = array();
        $classes = $this->dm->getConfiguration()->getMetadataDriverImpl()->getAllClassNames();

        foreach($classes as $class) {
            $choices[$class] = $class;
        }

        return $choices;
    }

    public function getName()
    {
        return 'doctrine_provider_block';
    }
}
