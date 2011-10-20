<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Templating\EngineInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\Block\Provider;
use Knp\Bundle\BlockBundle\Block\Renderer;

/**
 * The Block controller
 *
 * This controller handles edition, deletion and listing of Blocks
 *
 * @author fklein
 *
 */
class BlockController
{
    private $request;
    private $provider;
    private $engine;
    private $router;
    private $blockRenderer;

    /**
     *
     * @constructor
     * @param Request $request the current request
     * @param Provider $provider The Block Provider
     * @param EngineInterface $engine the templating engine
     * @param Router $router the routing service
     * @param renderer $blockRenderer the blockRenderer service
     */
    public function __construct(Request $request, Provider $provider, EngineInterface $engine, Router $router, Renderer $blockRenderer)
    {
        $this->request = $request;
        $this->provider = $provider;
        $this->engine = $engine;
        $this->router = $router;
        $this->blockRenderer = $blockRenderer;
    }

    public function indexAction()
    {
        $blocks = $this->provider->all();
        return $this->engine->renderResponse('KnpBlockBundle:Block:index.html.twig', array(
            'blocks' => $blocks
        ));
    }

    /**
     *
     * gets a preview of the rendering of a Block
     * @param $id
     */
    public function showAction($id)
    {
        $block = $this->provider->get($id);
        if(null === $block)
        {
            throw new NotFoundHttpException;
        }

        $blockType = $this->provider->getType($block->getBlockTypeId());

        return $this->engine->renderResponse($blockType->getShowTemplateName(), array(
            'block' => $block,
            'content' => $this->blockRenderer->render($block),
        ));
    }

    public function editAction($id)
    {
        $block = $this->provider->get($id);
        if(null === $block)
        {
            throw new NotFoundHttpException;
        }
        $blockType = $this->provider->getType($block->getBlockTypeId());
        $blockForm = $this->provider->getForm($blockType->getEditionFormId());
        $blockForm->setData($block);

        return $this->engine->renderResponse($blockType->getEditionTemplateName(), array(
            'block' => $block,
            'blockForm' => $blockForm->createView()
        ));
    }

    public function updateAction($id = null)
    {
        $block = $this->provider->get($id);
        if(null === $block)
        {
            throw new NotFoundHttpException;
        }
        $blockType = $this->provider->getType($block->getBlockTypeId());
        $blockForm = $this->provider->getForm($blockType->getEditionFormId());
        $blockForm->setData($block);

        $blockForm->bind($this->request->get($blockForm->getName()));
        if($blockForm->isValid()) {
            $this->provider->getDm()->persist($blockForm->getData());
            $this->provider->getDm()->flush();

            return new RedirectResponse($this->router->generate('knp_cmf_block_edit', array('id' => $block->getId())));
        }

        return $this->engine->renderResponse($blockType->getEditionTemplateName(), array(
            'block' => $block,
            'blockForm' => $blockForm->createView()
        ));
    }

    public function deleteAction($id)
    {
        $block = $this->provider->get($id);
        if(null === $block)
        {
            throw new NotFoundHttpException;
        }
        $this->provider->getDm()->delete($block);

        return new RedirectResponse($this->router->generate('knp_cmf_block_index'));
    }
}
