<?php

namespace Knp\Bundle\BlockBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Knp\Bundle\BlockBundle\DependencyInjection\Compiler\AddBlockTypesPass;
use Knp\Bundle\BlockBundle\DependencyInjection\Compiler\AddBlockFormsPass;

class KnpBlockBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AddBlockTypesPass);
        $container->addCompilerPass(new AddBlockFormsPass);
    }
}
