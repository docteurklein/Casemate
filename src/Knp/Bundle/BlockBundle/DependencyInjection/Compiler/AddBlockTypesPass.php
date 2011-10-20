<?php
namespace Knp\Bundle\BlockBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AddBlockTypesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('knp.cmf.block.provider')) {
            return;
        }

        if (!$container->hasDefinition('knp.cmf.block.mongodb.load_class_metada.event_listener')) {
            return;
        }
        $providerDefinition = $container->getDefinition('knp.cmf.block.provider');
        $listenerDefinition = $container->getDefinition('knp.cmf.block.mongodb.load_class_metada.event_listener');

        $taggedBlocks = $container->findTaggedServiceIds('knp.cmf.block_type');
        foreach ($taggedBlocks as $id => $attributes) {
            $definition = $container->getDefinition($id);
            $providerDefinition->addMethodCall('addBlockTypeId', array($id));

            $className = $this->getBlockClassName($definition, $attributes);
            $listenerDefinition->addMethodCall('addDiscriminatorMapping', array(
                $id,
                $className
            ));
        }
    }

    private function getBlockClassName(Definition $definition, array $attributes)
    {
        if (isset($attributes['disciminator-class'])) {
            $blockClassName = $attributes['disciminator-class'];
        }
        else {
            // TODO FIXME: this is based on conventions
            $refl = new \ReflectionClass($definition->getClass());
            $className = $refl->getName();
            $ns = $refl->getNamespaceName();

            $pos = strrpos($className, '\\');
            // get the latest part of full class name = short class name
            $shortClassName = false === $pos ? $className :  substr($className, $pos + 1);
            $shortClassName = str_replace('Type', '', $shortClassName);
            $blockClassName = $ns.'\\Document\\'.$shortClassName;
        }

        return $blockClassName;
    }
}
