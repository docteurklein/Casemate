<?php

namespace Knp\Bundle\BlockBundle\Tests\Block;

class BlockTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testConventionalNames()
    {
        $blockType = $this->getMockBuilder('Knp\Bundle\BlockBundle\BlockType\AbstractBlockType')
            ->setMockClassName('MySuperBlockType')->getMockForAbstractClass();

        $this->assertEquals('my_super', $blockType->getInternalName());
    }
}
