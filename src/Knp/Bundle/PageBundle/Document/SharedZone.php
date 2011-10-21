<?php

namespace Knp\Bundle\PageBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\Bundle\BlockBundle\Block\BlockInterface;


/**
 * @ODM\Document(collection="Zone")
 *
 * @author fklein
 *
 */
class SharedZone extends Zone
{
    public function __construct()
    {
        $this->setShared(true);
    }
}
