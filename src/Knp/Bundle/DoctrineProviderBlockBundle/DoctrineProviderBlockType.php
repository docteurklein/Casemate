<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle;

use Knp\Bundle\BlockBundle\BlockType\AbstractBlockType;
use Knp\Bundle\BlockBundle\BlockType\BlockTypeInterface;

class DoctrineProviderBlockType extends AbstractBlockType implements BlockTypeInterface
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
