<?php

namespace Knp\Bundle\BlockBundle\BlockType;

interface BlockTypeInterface
{
    /**
     *
     * Returns the displayed name of the BlockType
     */
    function getName();

    /**
     * Returns the internal name of the BlockType
     * It will help us to get informations based on conventions
     *
     * For example, if InternalName is 'static_block':
     *   - displayed name will be:          'Static block'
     *   - Form id will be:                 knp.cmf.form.static_block
     *   - Frontend controller will be:     knp.cmf.controller.static_block
     *   - show template will be:           KnpStaticBlockBundle:BlockType:static.html.twig
     *   - edition template will be:        KnpStaticBlockBundle:BlockType/Form:static.html.twig
     */
    function getInternalName();

    /**
     *
     * Returns the content of the twig template used to display edition form
     */
    function getEditionTemplateName();

    /**
     *
     * Returns the content of the twig template used to display preview
     */
    function getShowTemplateName();

    /**
     *
     * Returns the controller service id for block rendering
     * @return string
     */
    function getFrontendControllerId();

    /**
     *
     * Returns the Form service id to edit configuration
     * @return string
     */
    function getEditionFormId();

    /**
     *
     * Returns the default Caching HTTP Headers
     * @return array
     * @see Response::setCache
     */
    function getDefaultCacheHTTPHeaders();

}
