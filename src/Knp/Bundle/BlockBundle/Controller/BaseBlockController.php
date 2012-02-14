<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session;

use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Templating\EngineInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

use Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface;
use Knp\Bundle\BlockBundle\Block\BlockInterface;
use Knp\Bundle\BlockBundle\Block\Provider;
use Knp\Bundle\BlockBundle\Block\Renderer;
use Knp\Bundle\BlockBundle\BlockType\AbstractBlockType;

/**
 *
 */
abstract class BaseBlockController implements BaseBlockControllerInterface
{
    private $request;
    private $provider;
    private $engine;
    private $router;
    private $blockRenderer;
    private $session;

    /**
     * constructor
     * @param Request $request the current request
     * @param Provider $provider the Block Provider
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

    public function esiRender(Request $request)
    {
        $block = $this->provider->get($request->query->get('blockId'));

        return $this->render($block);
    }

    /**
     * Set the current session
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::setSession()
     *
     * @param Session $session the current session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Get the current Session object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getSession()
     *
     * @return Session the current session
     * @throws Symfony\Component\DependencyInjection\Exception\InvalidArgumentException if session not available
     */
    public function getSession()
    {
        if (null === $this->session) {
            throw new Symfony\Component\DependencyInjection\Exception\InvalidArgumentException();
        }
        return $this->session;
    }

    /**
     * Get the current Request object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getRequest()
     *
     * @return Request the current request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the Engine object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getTemplatingEngine()
     *
     * @return EngineInterface the current template engine
     */
    public function getTemplatingEngine()
    {
        return $this->engine;
    }

    /**
     * Get the Router object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getRouter()
     *
     * @return Router the current router
     */
    public function getRouter()
    {
        return $this->router;
    }


    /**
     * Get the BlockRenderer object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getBlockRenderer()
     *
     * @return Renderer the block renderer
     */
    public function getBlockRenderer()
    {
        return $this->blockRenderer;
    }

    /**
     * Get the BlockProvider object
     * @see Knp\Bundle\BlockBundle\Controller\BaseBlockControllerInterface::getBlockProvider()
     *
     * @return Provider the block provider
     */
    public function getBlockProvider()
    {
        return $this->provider;
    }

    public function renderAction()
    {
        $blockId = $this->request->query->get('blockId');
        $block = $this->provider->get($blockId);

        return $this->render($block);
    }

    public function getResponseObject(AbstractBlockType $blockType)
    {
        $response = new Response;
        $response->headers->replace($blockType->getDefaultCacheHTTPHeaders());

        return $response;
    }
}
