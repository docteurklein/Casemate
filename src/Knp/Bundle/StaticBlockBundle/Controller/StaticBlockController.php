<?php

namespace Knp\Bundle\StaticBlockBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Knp\Bundle\BlockBundle\Controller\BlockControllerInterface;
use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Knp\Bundle\BlockBundle\Controller\BaseBlockController;


/**
 * The StaticBlock controller
 *
 * This controller handles display of StaticBlocks
 *
 * @author fklein
 *
 */
class StaticBlockController extends BaseBlockController implements BlockControllerInterface
{
    /**
     * Render a block
     * @see Knp\Bundle\BlockBundle\Controller\BlockControllerInterface::renderAction
     *
     * gets the rendering of a StaticBlock
     * @return Response
     */
    public function render(BlockInterface $block)
    {
        $blockType = $this->getBlockProvider()->getType($block->getBlockTypeId());

        $response = $this->getResponseObject($blockType);
        $response->setContent($block->getContent());

        return $response;
    }
}
