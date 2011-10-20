<?php

namespace Knp\Bundle\PageBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ODM\Document(collection="Page", repositoryClass="Knp\Bundle\PageBundle\Document\PageRepository")
 * @author fklein
 *
 */
class Page
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     *
     */
    private $name;

    /**
     * @ODM\Field(type="string")
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ODM\Field(type="string")
     *
     */
    private $layoutName;

    /**
     * @ODM\EmbedMany(targetDocument="Knp\Bundle\PageBundle\Document\Zone")
     *
     */
    private $zones;

    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLayoutName()
    {
        return $this->layoutName;
    }

    public function setLayoutName($name)
    {
        $this->layoutName = $name;
    }

    public function addZone(Zone $zone)
    {
        $this->zones[] = $zone;
    }

    public function setZones($zones)
    {
        $this->zones = $zones;
    }

    public function getZones()
    {
        return $this->zones;
    }
}
