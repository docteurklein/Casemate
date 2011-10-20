<?php
namespace Knp\Bundle\AdminMenuBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\Config\Definition\Processor;

use Symfony\Component\DependencyInjection\Definition;

class KnpAdminMenuExtension extends Extension
{
    /**
     * Loads the KnpAdminMenuExtension configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        if (!$container->hasDefinition('knp.admin_menu.config')) {
            $container->setDefinition('knp.admin_menu.config', new Definition(
                'Knp\Bundle\AdminMenuBundle\Services\Config',
                array($config)
            ));
        }

    }
}
