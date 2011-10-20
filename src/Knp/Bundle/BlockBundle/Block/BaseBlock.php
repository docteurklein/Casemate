<?php

namespace Knp\Bundle\BlockBundle\Block;

use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * A base of persistable Block
 *
 * @ODM\Document(collection="Block")
 *
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="block_type_discriminator")
 *
 * @see Knp\Bundle\BlockBundle\DependencyInjection\Compiler\AddBlockTypesPass for DiscriminatorMap
 * @see Knp\Doctrine\MongoDB\Event\LoadClassMetadaEventListener for DiscriminatorMap
 *
 * @author fklein
 */
class BaseBlock implements BlockInterface
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @see http://www.doctrine-project.org/docs/mongodb_odm/1.0/en/reference/inheritance-mapping.html#single-collection-inheritance
     *
     * @Assert\NotBlank(message = "a BlockType id is mandatory", groups="knp.cmf.validator.block")
     */
    protected $blockTypeId;

    /**
     * @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Please enter a block name", groups="knp.cmf.validator.block")
     */
    private $name;

    /**
     * @ODM\Field(type="string")
     */
    private $frontendControllerId;

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     *
     * Gets the persisted name of the block instance
     *
     * @return String the name of the block instance
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string the BlockType identifier
     */
    public function getBlockTypeId()
    {
        return $this->blockTypeId;
    }

    /**
     *
     * {@InheritDoc}
     */
    public function getFrontendControllerId()
    {
        return $this->frontendControllerId;
    }
}
