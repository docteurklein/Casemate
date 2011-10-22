<?php

namespace Knp\Bundle\DoctrineProviderBlockBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Knp\Bundle\BlockBundle\Document\Template;

use Knp\Bundle\DoctrineProviderBlockBundle\Document\DoctrineProviderBlock;

class LoadBlockData extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder()
    {
        return 20;
    }

    public function load($manager)
    {
        $this->buildBlocks($manager);
    }

    public function getBlocks(DocumentManager $dm)
    {
        $blocks = array();
        for($i = 1; $i <= 20; $i++) {
            $block = new DoctrineProviderBlock;
            $block->setName(sprintf('a doctrine_provider block n°%d', $i));
            $block->setClassName('Knp\\Bundle\\PageBundle\\Document\\Page');

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

