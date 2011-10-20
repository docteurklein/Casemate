<?php

namespace Knp\Bundle\PageBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use Knp\Bundle\PageBundle\Document\Page;
use Knp\Bundle\PageBundle\Document\Zone;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder()
    {
        return 50;
    }

    public function load($dm)
    {
        $this->dm = $dm;

        $pages = array();
        for($i = 1; $i <= 20; $i++) {
            $page = new Page;
            $page->setName(sprintf('a page n°%d', $i));

            //$layout = $i % 2 == 0 ? '2cols' : '3cols';
            $layout = '3cols';
            $page->setLayoutName(sprintf('KnpPageBundle:Page:%s.html.twig', $layout));

            $page->setZones($this->buildZones());

            $dm->persist($page);
        }

        $dm->flush();
    }

    private function buildZones()
    {
        $zones = array();
        $config = array(
            1 => array('left', true),
            2 => array('center', false),
            3 => array('right', true),
        );
        for($i = 1; $i <= 3; $i++) {
            $zone = new Zone;
            $zone->setName($config[$i][0]);
            $zone->setShared($config[$i][1]);

            $zone->setBlocks($this->getBlocks());

            $zones[] = $zone;
        }

        return $zones;
    }

    private function getBlocks()
    {
        return $this->dm->getRepository('Knp\Bundle\BlockBundle\Block\BaseBlock')
            ->createQueryBuilder()
            ->limit(10)
            ->getQuery()
            ->execute()
            ->toArray();
    }
}

