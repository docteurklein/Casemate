<?php

namespace Knp\Bundle\BlockBundle\Tests\Block;

use Knp\Bundle\BlockBundle\Block\Renderer;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    protected function getRenderer()
    {
        $provider = $this->getBlockProviderStub();
        $kernel = $this->getKernelStub();
        $renderer = new Renderer($kernel, $provider);

        return $renderer;
    }

    public function testFrontendControlerId()
    {
        $renderer = $this->getRenderer();

        $block = $this->getMock('Knp\Bundle\BlockBundle\Block\BlockInterface');
        $block
            ->expects($this->any())
            ->method('getFrontendControllerId')
            ->will($this->returnValue(null));

        $this->assertEquals('Test:Template:name.html.twig', $renderer->getFrontendControllerId($block));
    }

    public function testOverriddenFrontendControllerId()
    {
        $renderer = $this->getRenderer();

        $block = $this->getMock('Knp\Bundle\BlockBundle\Block\BlockInterface');
        $block
            ->expects($this->any())
            ->method('getFrontendControllerId')
            ->will($this->returnValue('Test:Another:template.html.twig'));

        $this->assertEquals('Test:Another:template.html.twig', $renderer->getFrontendControllerId($block));
    }

    protected function getKernelStub()
    {
        return $this->getMockBuilder('Symfony\Component\HttpKernel\HttpKernel')
            ->disableOriginalConstructor()->getMock();
    }

    protected function getBlockProviderStub()
    {
        $stub = $this->getMockBuilder('Knp\Bundle\BlockBundle\Block\Provider')
            ->disableOriginalConstructor()->getMock();

        $stub
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue($this->getBlockTypeStub()));

        return $stub;
    }

    protected function getBlockTypeStub()
    {
        $stub = $this->getMockBuilder('Knp\Bundle\BlockBundle\BlockType\BlockTypeInterface')
            ->disableOriginalConstructor()->getMock();

        $stub
            ->expects($this->any())
            ->method('getFrontendControllerId')
            ->will($this->returnValue('Test:Template:name.html.twig'));

        return $stub;
    }
}
