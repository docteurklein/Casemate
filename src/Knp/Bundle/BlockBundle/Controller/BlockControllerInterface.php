<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface;

/**
 * This is the interface any block should implements
 *
 * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface
 */
interface BlockControllerInterface extends BaseBlockControllerInterface
{
    /**
     * Render a block for a current page
     *
     * @param BlockInterface $block the block to render
     *
     * @return Response the Symfony\Component\HttpFoundation\Response
     */
    function render(BlockInterface $block);


    /**
     * Render a block for a current page
     *
     * receives in request query:
     *       int    $blockId    the block id to render
     *
     * @return Response the Symfony\Component\HttpFoundation\Response
     */
    function renderAction();
}
