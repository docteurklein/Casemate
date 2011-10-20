<?php

require_once __DIR__.'/../../../../app/autoload.php';
require_once __DIR__.'/../TestCase.php';

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

// needed by Symfony\Bundle\FrameworkBundle\Test\WebTestCase
$_SERVER['KERNEL_DIR'] = __DIR__.'/../../../../app';

// reload data fixtures
//$test = new Knp\Test\TestCase;
//$test->loadMongoDBDataFixtures();
