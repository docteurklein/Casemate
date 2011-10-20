<?php

namespace Knp\Bundle\AdminMenuBundle\Services;

class Config
{
	private $items;

	/**
     * @param $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }
}
