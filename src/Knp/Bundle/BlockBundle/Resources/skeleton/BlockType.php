<?php

namespace {{ namespace }};

use Knp\Bundle\BlockBundle\BlockType\AbstractBlockType;
use Knp\Bundle\BlockBundle\BlockType\BlockTypeInterface;

class {{ bundle_basename }}Type extends AbstractBlockType implements BlockTypeInterface
{
    /**
     * @see Knp\Bundle\BlockBundle\BlockType\AbstractBlockType::getDefaultCacheHTTPHeaders()
     */
    public function getDefaultCacheHTTPHeaders()
    {
        return array(
            'max_age' => 3600
        );
    }
}
