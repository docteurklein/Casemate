<?php

namespace Knp\Bundle\PageBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\Bundle\BlockBundle\Block\BlockInterface;


/**
 * ODM\Document(collection="Zone")
 * @ODM\EmbeddedDocument
 *
 * @author fklein
 *
 */
class Zone
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @ODM\Field(type="boolean")
     */
    private $shared;

    /**
     * @ODM\EmbedMany(targetDocument="Knp\Bundle\BlockBundle\Block\BaseBlock")
     *
     */
    private $blocks;

    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addBlock(BlockInterface $block)
    {
        $this->blocks[] = $block;
    }

    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function isShared()
    {
        return $this->shared;
    }

    public function setShared($shared)
    {
        $this->shared = $shared;
    }
}
