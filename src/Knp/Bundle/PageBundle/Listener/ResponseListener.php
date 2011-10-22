<?php

namespace Knp\Bundle\PageBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\templating\Helper\CoreAssetsHelper;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\HttpKernel;

/**
 * ResponseListener injects the translator js code.
 *
 * The handle method must be connected to the onCoreResponse event.
 *
 * The js is only injected on well-formed HTML (with a proper </body> tag).
 *
 */
class ResponseListener
{
    const IS_SUB_REQUEST = '_is_sub';
    private $assetHelper;
    private $router;

    public function __construct(CoreAssetsHelper $assetHelper, RouterInterface $router, HttpKernel $kernel)
    {
        $this->assetHelper = $assetHelper;
        $this->router = $router;
        $this->kernel = $kernel;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()
        or $event->getRequest()->query->has(self::IS_SUB_REQUEST)) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        // do not capture redirects or modify XML HTTP Requests
        if ($request->isXmlHttpRequest()) {
            return;
        }

        $this->injectScripts($response);
        $this->injectCss($response);
    }

    /**
     * Injects the js scripts into the given Response.
     *
     * @param Response $response A Response instance
     */
    protected function injectScripts(Response $response)
    {
        if (function_exists('mb_stripos')) {
            $posrFunction = 'mb_strripos';
            $substrFunction = 'mb_substr';
        } else {
            $posrFunction = 'strripos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();

        if (false !== $pos = $posrFunction($content, '</body>')) {

            $html = $this->kernel->render('KnpPageBundle:Page:toolbar');

            $url = $this->assetHelper->getUrl('bundles/knppage/js/ext-core.js');
            $html .= sprintf('<script type="text/javascript" src="%s"></script>', $url)."\n";

            $url = $this->assetHelper->getUrl('bundles/knppage/js/menu.js');
            $html .= sprintf('<script type="text/javascript" src="%s"></script>', $url)."\n";

            $url = $this->assetHelper->getUrl('bundles/knppage/js/pageEditor.js');
            $html .= sprintf('<script type="text/javascript" src="%s"></script>', $url)."\n";

            $script = <<<HTML
<script type="text/javascript">
    Ext.onReady(function() {
        new Knplabs.Cmf.PageEditor({

        });
    });
</script>
HTML;
            $html .= $script;

            $content = $substrFunction($content, 0, $pos).$html.$substrFunction($content, $pos);
            $response->setContent($content);
        }
    }

    /**
     * Injects the css links into the given Response.
     *
     * @param Response $response A Response instance
     */
    protected function injectCss(Response $response)
    {
        if (function_exists('mb_stripos')) {
            $posrFunction = 'mb_strripos';
            $substrFunction = 'mb_substr';
        } else {
            $posrFunction = 'strripos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();

        if (false !== $pos = $posrFunction($content, '</head>')) {

            $url = $this->assetHelper->getUrl('bundles/knppage/css/menu.css');
            $links = sprintf('<link rel="stylesheet" href="%s" />', $url);

            $content = $substrFunction($content, 0, $pos).$links.$substrFunction($content, $pos);
            $response->setContent($content);
        }
    }
}
