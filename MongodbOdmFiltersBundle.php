<?php

namespace Symftony\MongodbOdmFiltersBundle;

use Symftony\MongodbOdmFiltersBundle\DependencyInjection\Compiler\MongodbOdmFiltersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MongodbOdmFiltersBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MongodbOdmFiltersPass());
    }
}
