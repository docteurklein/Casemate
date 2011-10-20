<?php
namespace Knp\Bundle\BlockBundle\Document;

use Knp\Bundle\BlockBundle\Form\ToIdTransformable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 * @author fklein
 *
 * TODO make it softDeletable, versionable
 */
class Template implements ToIdTransformable
{
	/**
	 * @ODM\Id
	 */
	private $id;

	/**
     * @ODM\Field(type="string")
	 */
	private $name;

	/**
     * @ODM\Field(type="string")
	 */
	private $content;

	/**
     * @ODM\Field(type="string")
	 */
	private $category;

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

	public function getContent()
	{
	    return $this->content;
	}

    public function setContent($content)
    {
        $this->content = $content;
    }

	/**
	 * Gets the category name
	 * @return string
	 */
	public function getCategory()
	{
        return $this->category;
	}

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
