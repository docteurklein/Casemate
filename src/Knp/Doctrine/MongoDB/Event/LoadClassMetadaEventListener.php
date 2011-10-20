<?php

namespace Knp\Doctrine\MongoDB\Event;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;

/**
 *
 * LoadClassMetadaEventListener listens to Doctrine\ODM
 * to dynamically add a discrimator map in the BaseBlock class metadata
 * @author fklein
 *
 */
class LoadClassMetadaEventListener
{
    private $map = array();
    private $className;

    /**
     * @param string $clasName the full class name to map
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * This method is called to populate available Documents thanks to a CompilerPass
     *
     * @see Knp\BlockBundle\DependencyExtension\Compiler\AddBlockTypesPass
     * @param string $alias
     * @param string $className
     */
    public function addDiscriminatorMapping($alias, $className)
    {
        $this->map[$alias] = $className;
    }

    /**
     *
     * This event listener handles automagically the DiscriminatorMap configuration of BaseBlock
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        if ($classMetadata->getName() == $this->className) {
            $classMetadata->setDiscriminatorMap($this->map);
        }
    }
}
