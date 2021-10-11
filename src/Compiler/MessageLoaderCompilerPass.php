<?php

declare(strict_types=1);

namespace Oscmarb\MessengerBusBundle\Compiler;

use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponseRegistry;
use Oscmarb\MessengerBusBundle\ClassLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class MessageLoaderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $classLoader = new ClassLoader();

        $container->addDefinitions(
            [
                CommandRegistry::class => new Definition(
                    CommandRegistry::class,
                    [$classLoader->commands()]
                ),
                QueryRegistry::class => new Definition(
                    QueryRegistry::class,
                    [$classLoader->queries()]
                ),
                DomainEventRegistry::class => new Definition(
                    DomainEventRegistry::class,
                    [$classLoader->domainEvents()]
                ),
                QueryResponseRegistry::class => new Definition(
                    QueryResponseRegistry::class,
                    [$classLoader->queryResponses()]
                ),
            ]
        );
    }
}