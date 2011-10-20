<?php

namespace Knp\Bundle\BlockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController
{
    public function indexAction()
    {
        return $this->render('KnpBlockBundle:Default:index.html.twig');
    }
}
