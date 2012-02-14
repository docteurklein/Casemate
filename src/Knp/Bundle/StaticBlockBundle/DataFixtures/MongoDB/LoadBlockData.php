<?php

namespace Knp\Bundle\StaticBlockBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Knp\Bundle\BlockBundle\Document\Template;

use Knp\Bundle\StaticBlockBundle\Document\StaticBlock;

class LoadBlockData extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder()
    {
        return 20;
    }

    public function load(ObjectManager $manager)
    {
        $this->buildBlocks($manager);
    }

    public function getBlocks(DocumentManager $dm)
    {
        $blocks = array();
        for($i = 1; $i <= 20; $i++) {
            $block = new StaticBlock;
            $block->setName(sprintf('a static block n°%d', $i));
            $block->setContent('a <b>dumb</b> <i>static</i> content');

            $blocks[] = $block;
        }

        return $blocks;
    }

    public function buildBlocks(DocumentManager $dm)
    {
        foreach($this->getBlocks($dm) as $block) {
            $dm->persist($block);
        }
        $dm->flush();
    }
}

