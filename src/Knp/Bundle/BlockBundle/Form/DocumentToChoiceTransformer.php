<?php

namespace Knp\Bundle\BlockBundle\Form;

use Doctrine\ODM\MongoDB\DocumentManager;

use Symfony\Component\Form\DataTransformerInterface;
use Knp\Bundle\BlockBundle\Form\ToIdTransformable;

class DocumentToChoiceTransformer implements DataTransformerInterface
{
    private $dm;
    private $className;

    public function __construct(DocumentManager $dm, $className)
    {
        $this->dm = $dm;
        $this->className = $className;
    }

    public function transform($value)
    {
        if(null === $value) {

            return '';
        }

        if(is_scalar($value)) {
            return $this->dm->getRepository($this->className)->find($value);
        }

        if( ! $value instanceof ToIdTransformable) {
            throw new \InvalidArgumentException(sprintf('Object must implement "ToIdTransformable" interface'));
        }

        return $value->getId();
    }

    public function reverseTransform($value)
    {
        if(is_scalar($value)) {
            return $this->dm->getRepository($this->className)->find($value);
        }
    }
}
