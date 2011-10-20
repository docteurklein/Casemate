<?php
namespace Knp\Bundle\PageBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\Config\Definition\Processor;

use Symfony\Component\DependencyInjection\Definition;

class KnpPageExtension extends Extension
{
    /**
     * Loads the KnpPageBundleExtension configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('repositories.xml');
        $loader->load('toolbar.xml');
    }
}
