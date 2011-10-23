<?php

namespace {{ namespace }};

use Knp\Bundle\BlockBundle\Block\BaseBlock;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 *
 * A persistable StaticBlock
 *
 * @ODM\Document
 */
 class {{ bundle_basename }} extends BaseBlock
{
protected $blockTypeId = 'block_type.{{ extension_alias }}';
    // TODO put some block specific persistable data
}
