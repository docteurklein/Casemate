<?php

namespace Knp\Bundle\AdminMenuBundle\Services;

use Knp\Bundle\MenuBundle\Menu;
use Knp\Bundle\MenuBundle\MenuItem;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Router;

use Knp\Bundle\AdminMenuBundle\Services\Config;

class AdminMenu extends Menu
{
    private $router;

	/**
     * @param Request $request
     * @param Router $router
     */
    public function __construct(Request $request, Router $router, Config $config)
    {
        parent::__construct();

        $this->router = $router;

        $this->setAttribute('id', 'nav');

        $this->setCurrentUri($request->getRequestUri());

        $this->prepare($config->getItems(), $this);
    }

    private function prepare($config, MenuItem $parent = null)
    {

        foreach($config as $k=>$item)
        {
            $parent->addChild($k, $this->router->generate($item['url'], $item['url_params']));
            $parent[$k]->setLabel($item['name']);

            if(array_key_exists('childs',$item))
            {
               $this->prepare($item['childs'],$parent[$k]);
            }
        }

    }

}
