<?php

namespace Knp\Bundle\BlockBundle\Block;

interface BlockInterface
{
    /**
     *
     * Returns the displayed name of the BlokType
     */
    function getName();

    /**
     *
     * @return string the service id of the block type
     */
    function getBlockTypeId();

    /**
     *
     * @return string the template name
     */
    function getFrontendControllerId();
}
