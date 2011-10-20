<?php

$steps->Given('/^I edit the block named "([^"]*)"$/', function($world, $name) {

    $block = $world->getKernel()->getContainer()
        ->get('knp.cmf.block.base_block.repository')
    ->findOneBy(array('name' => $name));

    $world->current_block = $block;

    $url = $world->getKernel()->getContainer()->get('router')->generate('knp_cmf_block_edit', array('id' => $block ? $block->getId(): ''));

    $world->getSession()->visit($world->getPathTo($url));
});

$steps->When('/^(?:|I )select the template "(?P<option>[^"]*)" from "(?P<select>[^"]*)"$/', function($world, $select, $option) {

    $template = $block = $world->getKernel()->getContainer()
            ->get('knp.cmf.block.template.repository')
            ->findOneBy(array('name' => $option));

    $world->getSession()->getPage()->selectFieldOption($select, $template->getId());
});

$steps->Then('/^the current block should have the  "(?P<name>[^"]*)" template $/', function($world, $name) {
    $template = $block = $world->getKernel()->getContainer()
        ->get('knp.cmf.block.template.repository')
    ->findOneBy(array('name' => $name));

    assertEquals($template->getName(), $world->current_block->getName());
});
