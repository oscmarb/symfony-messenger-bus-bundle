<?php

declare(strict_types=1);

namespace Oscmarb\MessengerBusBundle\Compiler;

use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponseRegistry;
use Oscmarb\Ddd\Domain\Service\Message\MessageSerializer;
use Oscmarb\Ddd\Domain\Service\Message\PublicMessageSerializer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class MessageSerializerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->addDefinitions(
            [
                MessageSerializer::class => new Definition(
                    MessageSerializer::class,
                    [
                        new Reference(CommandRegistry::class),
                        new Reference(QueryRegistry::class),
                        new Reference(DomainEventRegistry::class),
                        new Reference(QueryResponseRegistry::class),
                    ]
                ),
                PublicMessageSerializer::class => new Definition(
                    PublicMessageSerializer::class,
                    [
                        new Reference(MessageSerializer::class),
                    ]
                ),
            ]
        );
    }
}