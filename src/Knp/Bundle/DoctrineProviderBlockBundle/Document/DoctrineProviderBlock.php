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

    /**
     * @ODM\Field(type="string")
     */
    private $listTemplate;

    /**
     * @ODM\Field(type="string")
     */
    private $viewTemplate;

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * Get listTemplate.
     *
     * @return listTemplate.
     */
    public function getListTemplate()
    {
        return $this->listTemplate;
    }

    /**
     * Set listTemplate.
     *
     * @param listTemplate the value to set.
     */
    public function setListTemplate($listTemplate)
    {
        $this->listTemplate = $listTemplate;
    }

    /**
     * Get viewTemplate.
     *
     * @return viewTemplate.
     */
    public function getViewTemplate()
    {
        return $this->viewTemplate;
    }

    /**
     * Set viewTemplate.
     *
     * @param viewTemplate the value to set.
     */
    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
    }
}
