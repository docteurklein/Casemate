<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle\Document;

use Knp\Bundle\BlockBundle\Block\BaseBlock;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 *
 * A persistable DoctrineProviderBlock
 *
 * @ODM\Document
 * @author fklein
 */
class DoctrineProviderBlock extends BaseBlock
{
    protected $blockTypeId = 'knp.cmf.block_type.doctrine_provider';

    /**
     * @ODM\Field(type="string")
     * assert:Type(value="string", message = "Please enter a valid class name", groups="knp.cmf.validator.block")
     */
    private $className;

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }
}
