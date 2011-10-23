<?php

namespace {{ namespace }}\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
{% if 'annotation' == format -%}
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
{%- endif %}


class {{ bundle_basename }}Controller extends Controller
{
    {% if 'annotation' == format -%}
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    {%- endif %}

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

        //TODO populate the response content
        //$respnse->setContent('block specific content');

        return $response;
    }
}
