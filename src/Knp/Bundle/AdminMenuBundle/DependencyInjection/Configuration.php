<?php

namespace Knp\Bundle\AdminMenuBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
* This class contains the configuration information for the bundle
*
* @author clombardot
*/
class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('knp_admin_menu');

        $node =$rootNode->useAttributeAsKey('key', false);
        $node->prototype('array')
                ->children()
                    ->scalarNode('url')
                        ->cannotBeEmpty()
                    ->end()
                    ->arrayNode('url_params')
                        ->useAttributeAsKey('key')
                            ->prototype('scalar')
                        ->end()
                    ->end()
                    ->scalarNode('name')
                        ->cannotBeEmpty()
                    ->end()
                ->end()
                ->append($this->getChildNode())
            ->end()
            ;

        return $treeBuilder;
    }

    protected function getChildNode()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('childs');

         $node->prototype('array')
                    ->children()
                        ->scalarNode('url')
                            ->cannotBeEmpty()
                        ->end()
                        ->arrayNode('url_params')
                            ->useAttributeAsKey('key')
                                ->prototype('scalar')
                            ->end()
                        ->end()
                        ->scalarNode('name')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end();

        return $node;
    }

}
