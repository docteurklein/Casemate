<?php

namespace Knp\Bundle\BlockBundle\BlockType;

/**
 * Base class for all BlockType
 *
 * This base class enforce a lot a convention.
 *
 */
abstract class AbstractBlockType
{
    /**
     * Get the Block name
     *
     * @return string the block name
     */
    public function getName()
    {
        return get_class($this);
    }

    /**
     * Underscore a className
     * ex : KnpStaticBlockType => knp_static_block_type
     *
     * @return string the underscored class name
     */
    static private function underscore($name)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($name, '_', '.')));
    }

    /**
     * Get the block internal Name
     *
     * @return string the block internal name
     */
    public function getInternalName()
    {
        // get the full class name
        $className = get_class($this);
        $pos = strrpos($className, '\\');
        // get the latest part of full class name = short class name
        $className = false === $pos ? $className :  substr($className, $pos + 1);
        // remove Block and Type from short class name
        $className = str_replace(array('Type', 'Block'), '', $className);

        // return the underscored name
        return self::underscore($className);
    }

    /**
     * Return the template symfony path used for edit a block in the backend
     *
     * @return string
     */
    public function getEditionTemplateName()
    {
        return sprintf('Knp%sBlockBundle:BlockType/Form:%s.html.twig', ucfirst($this->getInternalName()), $this->getInternalName());
    }

    /**
     * Return the template symfony path used for preview a block in the backend
     *
     * @return string
     */
    public function getShowTemplateName()
    {
        return sprintf('Knp%sBlockBundle:BlockType:%s.html.twig', ucfirst($this->getInternalName()), $this->getInternalName());
    }

    /**
     * Get the service id for the associated block form
     *
     * @return string
     */
    public function getEditionFormId()
    {
        return sprintf('knp.cmf.form.%s_block', $this->getInternalName());
    }

    /**
     * Get the service id for the associated block controller
     *
     * @return string
     */
    public function getFrontendControllerId()
    {
        return sprintf('knp.cmf.controller.%s_block', $this->getInternalName());
    }

    /**
     * Get the default Cache Options
     *
     * @see Knp\Bundle\BlockBundle\BlockType\AbstractBlockType::getDefaultCacheHTTPHeaders()
     * @return array array of cache options
     */
    public function getDefaultCacheHTTPHeaders()
    {
        return array();
    }
}
