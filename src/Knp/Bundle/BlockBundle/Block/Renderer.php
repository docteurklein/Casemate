<?php

namespace Knp\Bundle\BlockBundle\Block;

use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Knp\Bundle\BlockBundle\Block\Provider;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Knp\Bundle\PageBundle\Listener\ResponseListener;

/**
 *
 * the Renderer class is used to render Blocks
 *
 * @author fklein
 */
class Renderer
{
    private $kernel;
    private $provider;

    public function __construct(HttpKernel $kernel, Provider $provider)
    {
        $this->kernel = $kernel;
        $this->provider = $provider;
    }

    public function render(BlockInterface $block, array $params = array())
    {
        $params = array_merge(array(
            'query'      => array('blockId' => $block->getId()),
            'attributes' => array('block' => $block),
            'standalone' => true,
        ), $params);

        if(true === $params['standalone']) {
            $params['query'][ResponseListener::IS_SUB_REQUEST] = 'yes';
            return $this->kernel->render($this->getFrontendControllerId($block).':esiRender', $params);
        }
        return $this->kernel->render($this->getFrontendControllerId($block).':render', $params);
    }

    public function getFrontendControllerId(BlockInterface $block)
    {
        if(null !== $id = $block->getFrontendControllerId()) {
            return $id;
        }

        $blockType = $this->provider->getType($block->getBlockTypeId());

        return $blockType->getFrontendControllerId();
    }
}
