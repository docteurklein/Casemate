<?php

namespace Knp\Bundle\BlockBundle\Tests\Block;

use Knp\Bundle\BlockBundle\Block\Provider;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    protected function getProvider()
    {
        $dm = $this->getDocumentManagerStub();
        $container = $this->getContainerStub();
        $provider = new Provider($dm, $container);

        return $provider;
    }

    public function testAddBlockTypes()
    {
        $provider = $this->getProvider();

        $provider->addBlockTypeId('block_type_id');

        $this->assertEquals($provider->getType('block_type_id'), $this->getBlockTypeStub());

        $this->assertEquals(array('block_type_id' => 'block_type_id'), $provider->allTypeIds());
    }

    protected function getContainerStub()
    {
        $stub = $this->getMockBuilder('Symfony\Component\DependencyInjection\Container')
            ->disableOriginalConstructor()->getMock();

        $stub
            ->expects($this->any())
            ->method('get')
            ->with('block_type_id')
            ->will($this->returnValue($this->getBlockTypeStub()));

        return $stub;
    }

    protected function getDocumentManagerStub()
    {
        return $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()->getMock();
    }

    protected function getBlockTypeStub()
    {
        $stub = $this->getMockBuilder('Knp\Bundle\BlockBundle\BlockType\BlockTypeInterface')
            ->disableOriginalConstructor()->getMock();

        $stub
            ->expects($this->any())
            ->method('getFrontendTemplateName')
            ->will($this->returnValue('Test:Template:name.html.twig'));

        return $stub;
    }
}
