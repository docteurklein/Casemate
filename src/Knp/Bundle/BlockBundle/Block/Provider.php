<?php

namespace Knp\Bundle\BlockBundle\Block;
use Symfony\Component\Form\Form;
use Symfony\Component\DependencyInjection\Container;

use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\BlockType\BlockTypeInterface;

/**
 *
 * the Provider class is used to manipulate Blocks, BlockTypes and blockForms
 *
 * @author fklein
 */
class Provider
{
    private $blockTypeIds;
    private $blockFormIds;
    private $dm;
    private $container;

    public function __construct(DocumentManager $dm, Container $container)
    {
        $this->dm = $dm;
        $this->container = $container;
    }

    /**
     * returns the DocumentManager
     * @return DocumentManager
     */
    public function getDm()
    {
        return $this->dm;
    }

    /**
     *
     * Gets an instance of Block based on a mongoDB id
     * @param $id the MongoDB id
     *
     * @return any *Block registered in the discriminator map of BaseBlock
     */
    public function get($id)
    {
        return $this->dm->getRepository('Knp\Bundle\BlockBundle\Block\BaseBlock')->find($id);
    }

    public function all()
    {
        return $this->dm->getRepository('Knp\Bundle\BlockBundle\Block\BaseBlock')->findAll();
    }

    /**
     *
     * This method registers a blockType in the application
     *
     * @param $id the BlockType service id
     * @param $blockType
     *
     * @see Knp\Bundle\BlockBundle\DependencyInjection\Compiler\AddBlockTypesPass
     */
    public function addBlockTypeId($id)
    {
        $this->blockTypeIds[$id] = $id;
    }

    /**
     *
     * This method registers a blockForm in the application
     *
     * @param $id the BlockForm service id
     * @param Form $blockForm
     *
     * @see Knp\Bundle\BlockBundle\DependencyInjection\Compiler\AddBlockFormsPass
     */
    public function addBlockFormId($id)
    {
        $this->blockFormIds[$id] = $id;
    }

    /**
     * Gets a blockType by id
     *
     * @param $type the id of the blockType
     * @return BlockTypeInterface a BlockType
     */
    public function getType($type)
    {
        if(false === isset($this->blockTypeIds[$type])) {
            throw new \OutOfBoundsException(sprintf('Undefined BlockType "%s"', $type));
        }

        return $this->container->get($this->blockTypeIds[$type]);
    }

    public function allTypes()
    {
        $blockTypes = array();
        foreach($this->allTypeIds() as $typeId) {
            $blockTypes[$typeId] = $this->container->get($typeId);
        }

        return $blockTypes;
    }

    public function allTypeIds()
    {
        return $this->blockTypeIds;
    }

    /**
     * Gets a blockForm by id
     *
     * @param $type the id of the blockForm
     * @return Form a blockForm
     */
    public function getForm($id)
    {
        if(false === isset($this->blockFormIds[$id])) {
            throw new \OutOfBoundsException(sprintf('Undefined BlockForm "%s"', $id));
        }

        return $this->container->get($this->blockFormIds[$id]);
    }

    public function allFormIds()
    {
        return $this->blockFormIds;
    }
}
