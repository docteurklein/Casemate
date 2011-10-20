<?php

require __DIR__.'/../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;


$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    //Core
    'Symfony'                        => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'                         => __DIR__.'/../vendor/bundles',

    //Doctrine
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-data-fixtures/lib',
    'Doctrine\\Common'               => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\MongoDB'              => __DIR__.'/../vendor/doctrine-mongodb/lib',
    'Doctrine\\ODM'                  => __DIR__.'/../vendor/doctrine-mongodb-odm/lib',
    'Monolog'                        => __DIR__.'/../vendor/monolog/src',

    //Tools
    'Assetic'                        => __DIR__.'/../vendor/assetic/src',
    'Stof'                           => __DIR__.'/../vendor/bundles',
    'Gedmo'                          => __DIR__.'/../vendor/gedmo-doctrine-extensions/lib',
    'Knp'                            => array(__DIR__.'/../vendor/bundles', __DIR__.'/../src/'),

    //Behat
    'Behat\\BehatBundle'             => __DIR__.'/../vendor',
    'Behat\\MinkBundle'              => __DIR__.'/../vendor',
    'Behat\\Behat'                   => __DIR__.'/../vendor/Behat/Behat/src',
    'Behat\\SahiClient'              => __DIR__.'/../vendor/Behat/SahiClient/src',
    'Behat\\Mink'                    => __DIR__.'/../vendor/Behat/Mink/src',
    'Behat\\Gherkin'                 => __DIR__.'/../vendor/Behat/Gherkin/src',

    'Buzz'                           => __DIR__.'/../vendor/Buzz/lib',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_'               => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'                          => __DIR__.'/../vendor/twig/lib',
    'Swift_'                         => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
$loader->registerPrefixFallbacks(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
));

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine-mongodb-odm/lib/Doctrine/ODM/MongoDB/Mapping/Annotations/DoctrineAnnotations.php');

