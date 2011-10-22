<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Knp\Bundle\BlockBundle\Controller\BlockControllerInterface;
use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Knp\Bundle\BlockBundle\Controller\BaseBlockController;
use Doctrine\ODM\MongoDB\DocumentManager;


/**
 * The DoctrineProviderBlock controller
 *
 * This controller handles display of DoctrineProviderBlocks
 *
 * @author fklein
 *
 * @Route(service="knp.cmf.controller.doctrine_provider_block")
 */
class DoctrineProviderBlockController extends BaseBlockController implements BlockControllerInterface
{
    private $dm;

    /**
     * Render a block
     * @see Knp\Bundle\BlockBundle\Controller\BlockControllerInterface::renderAction
     *
     * gets the rendering of a DoctrineProviderBlock
     * @return Response
     */
    public function render(BlockInterface $block)
    {
        $blockType = $this->getBlockProvider()->getType($block->getBlockTypeId());

        $response = $this->getResponseObject($blockType);

        return $this->indexAction($block->getId());
    }

    /**
     * indexAction
     * @Route("/{id}", name="knp_doctrine_provider_block_index")
     */
    public function indexAction($id)
    {
        $block = $this->getBlockProvider()->get($id);
        $items = $this->dm->getRepository($block->getClassName())->findAll();

        return $this
            ->getTemplatingEngine()
            ->renderResponse('KnpDoctrineProviderBlockBundle:Frontend:index.html.twig', array(
                'block' => $block,
                'items' => $items
            )
        );
    }

    /**
     * viewAction
     * @Route("/{id}/view/{itemId}", name="knp_doctrine_provider_block_view")
     */
    public function viewAction($id, $itemId)
    {
        $block = $this->getBlockProvider()->get($id);
        $item = $this->dm->getRepository($block->getClassName())->find($itemId);

        return $this
            ->getTemplatingEngine()
            ->renderResponse('KnpDoctrineProviderBlockBundle:Frontend:view.html.twig', array(
                'block' => $block,
                'item' => $item
            )
        );
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
}
