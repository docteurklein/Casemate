<?php

namespace Knp\Bundle\PageBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    /**
     * @Route("/", name="knp_front_page_index")
     */
    public function indexAction()
    {
        $pages = $this->get('knp.cmf.page.repository')->findAll();

        return $this->get('templating')->renderResponse('KnpPageBundle:Page:index.html.twig', array(
            'pages' => $pages
        ));
    }

    /**
     * @Route("/{slug}", name="knp_front_page_view")
     */
    public function viewAction($slug)
    {
        $page = $this->get('knp.cmf.page.repository')->find($slug);
        if(null === $page)
        {
            throw new NotFoundHttpException;
        }

        return $this->get('templating')->renderResponse($page->getLayoutName(), array(
            'page' => $page,
            'pageRepository' => $this->get('knp.cmf.page.repository'),
            'renderer' => $this->get('knp.cmf.block.renderer')
        ));
    }

    public function toolbarAction()
    {
        return $this->get('templating')->renderResponse('KnpPageBundle:Toolbar:toolbar.html.twig', array(
            'blockProvider' => $this->get('knp.cmf.block.provider')
        ));
    }
}
