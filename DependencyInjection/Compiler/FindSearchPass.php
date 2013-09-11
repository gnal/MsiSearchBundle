<?php

namespace Msi\SearchBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FindSearchPass implements CompilerPassInterface
{
    function process(ContainerBuilder $container)
    {
        $ids = [];
        foreach ($container->findTaggedServiceIds('msi.search') as $id => $tags) {
            $ids[] = $id;
        }
        $container->setParameter('msi_search.search_ids', $ids);
    }
}
