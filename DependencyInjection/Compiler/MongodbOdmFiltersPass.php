<?php

namespace Symftony\MongodbOdmFiltersBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

class MongodbOdmFiltersPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter('doctrine_mongodb.odm.document_managers')) {
            foreach ($container->getParameter('doctrine_mongodb.odm.document_managers') as $name => $service) {
                $configurationName = sprintf('doctrine_mongodb.odm.%s_configuration', $name);
                if ($container->hasDefinition($configurationName)) {
                    $configurationDef = $container->getDefinition($configurationName);
                    $calls = $configurationDef->getMethodCalls();
                    foreach ($calls as &$call) {
                        if ($call[0] === 'addFilter') {
                            foreach ($call[1][2] as &$parameter) {
                                if (0 === strpos($parameter, '@')) {
                                    $parameter = new Reference(substr($parameter, 1), ContainerInterface::NULL_ON_INVALID_REFERENCE);
                                }
                            }
                        }
                    }
                    $configurationDef->setMethodCalls($calls);
                }
            }
        }
    }
}
