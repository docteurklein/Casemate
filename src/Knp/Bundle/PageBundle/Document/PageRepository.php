<?php

namespace Knp\Bundle\PageBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class PageRepository extends DocumentRepository
{
    /**
     * returns a page given it's slug
     *
     * @param string $slug the slug
     * @return Page
     */
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }

    public function getZone(Page $page, $name, $shared = false)
    {
        if($shared) {
            $zone = $this->getDocumentManager()->getRepository('Knp\Bundle\PageBundle\Document\SharedZone')->findOneBy(array(
                'name' => $name,
            ));

            return $zone;
        }

        foreach($page->getZones() as $zone) {
            if($zone->getName() === $name) {

                return $zone;
            }
        }
    }
}
