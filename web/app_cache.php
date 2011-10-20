<?php

require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/AppCache.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppCache(new AppKernel('dev', true));
$kernel->handle(Request::createFromGlobals())->send();
