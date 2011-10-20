<?php
namespace Knp\Bundle\BlockBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\FileLocateor;

use Doctrine\ODM\MongoDB\DocumentManager;

class KnpBlockExtension extends Extension
{
    /**
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('block_types.xml');
        $loader->load('controllers.xml');
        $loader->load('repositories.xml');
        $loader->load('renderer.xml');
    }

    /**
     * @static
     * @param DocumentManager $manager
     * @param  $className
     * @return DocumentRepository
     */
    public static function getRepository(DocumentManager $manager, $className)
    {
        return $manager->getRepository($className);
    }
}
