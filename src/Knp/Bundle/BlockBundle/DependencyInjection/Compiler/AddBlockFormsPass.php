<?php
namespace Knp\Bundle\BlockBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AddBlockFormsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('knp.cmf.block.provider')) {
            return;
        }

        $providerDefinition = $container->getDefinition('knp.cmf.block.provider');

        foreach ($container->findTaggedServiceIds('knp.cmf.block_type.form') as $id => $attributes) {
            //$definition = $container->getDefinition($id);
            $providerDefinition->addMethodCall('addBlockFormId', array($id));
        }
    }
}
