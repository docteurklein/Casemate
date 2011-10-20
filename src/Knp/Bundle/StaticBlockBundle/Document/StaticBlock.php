<?php

namespace Knp\Bundle\StaticBlockBundle\Document;

use Knp\Bundle\BlockBundle\Block\BaseBlock;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 *
 * A persistable StaticBlock
 *
 * @ODM\Document
 * @author fklein
 */
class StaticBlock extends BaseBlock
{
    protected $blockTypeId = 'knp.cmf.block_type.static';

    /**
     * @ODM\Field(type="string")
     * assert:Type(value="string", message = "Please enter a valid content", groups="knp.cmf.validator.block")
     */
    private $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}
