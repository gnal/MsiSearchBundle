<?php

namespace Msi\SearchBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Msi\SearchBundle\DependencyInjection\Compiler\FindSearchPass;

class MsiSearchBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FindSearchPass());
    }
}
