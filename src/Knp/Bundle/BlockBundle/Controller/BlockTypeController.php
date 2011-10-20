<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Templating\EngineInterface;

use Knp\Bundle\BlockBundle\Block\Provider;

class BlockTypeController
{
    private $provider;
    private $engine;

    public function __construct(Provider $provider, EngineInterface $engine)
    {
        $this->provider = $provider;
        $this->engine = $engine;
    }

    public function indexAction()
    {
        return $this->engine->renderResponse('KnpBlockBundle:BlockType:index.html.twig', array(
            'blockTypes' => $this->provider->allTypes()
        ));
    }

}
