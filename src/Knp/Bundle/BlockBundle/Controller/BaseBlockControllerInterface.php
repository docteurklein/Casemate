<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Knp\Bundle\BlockBundle\Controller\BlockControllerInterface;
use Symfony\Component\HttpFoundation\Session;
use Knp\Bundle\BlockBundle\BlockType\AbstractBlockType;

/**
 * This is the interface for BaseBlockController
 *
 */
interface BaseBlockControllerInterface
{
    /**
     * Get the current Session object
     *
     * @return Session the current session
     * @throws Symfony\Component\DependencyInjection\Exception\InvalidArgumentException if session not available
     */
    function getSession();

    /**
     * Set the current session
     *
     * @param Session $session the current session
     */
    function setSession(Session $session);

    /**
     * Get the BlockRenderer object
     *
     * @return Renderer the block renderer
     */
    function getBlockRenderer();


    /**
     * Get the BlockProvider object
     *
     * @return Provider the block provider
     */
    function getBlockProvider();

    /**
     * Get the Engine object
     *
     * @return EngineInterface the current template engine
     */
    function getTemplatingEngine();


    /**
     * Get the Router object
     *
     * @return Router the current router
     */
    function getRequest();

    /**
     * Get the Router object
     *
     * @return Router the current router
     */
    function getRouter();

    /**
     * Get a configured Response object for this blockType
     *
     * @return Response
     */
    function getResponseObject(AbstractBlockType $blockType);

}
