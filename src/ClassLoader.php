<?php

declare(strict_types=1);

namespace Oscmarb\MessengerBusBundle;

use Oscmarb\Ddd\Domain\Command\Command;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;
use Oscmarb\Ddd\Domain\Query\Query;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponse;

final class ClassLoader
{
    private array $commands = [];
    private array $queries = [];
    private array $domainEvents = [];
    private array $queryResponses = [];

    public function __construct()
    {
        $this->loadMessages();
    }

    public function commands(): array
    {
        return $this->commands;
    }

    public function domainEvents(): array
    {
        return $this->domainEvents;
    }

    public function queries(): array
    {
        return $this->queries;
    }

    public function queryResponses(): array
    {
        return $this->queryResponses;
    }

    private function loadMessages(): void
    {
        $classes = \get_declared_classes();

        foreach ($classes as $class) {
            $reflection = new \ReflectionClass($class);

            if (true === $reflection->isAbstract()) {
                continue;
            }

            if (true === $reflection->isSubclassOf(Command::class)) {
                /** @var Command $class */
                $this->commands[] = $class;
            } elseif (true === $reflection->isSubclassOf(DomainEvent::class)) {
                /** @var DomainEvent $class */
                $this->domainEvents[] = $class;
            } elseif (true === $reflection->isSubclassOf(Query::class)) {
                /** @var Query $class */
                $this->queries[] = $class;
            } elseif (true === $reflection->isSubclassOf(QueryResponse::class)) {
                /** @var QueryResponse $class */
                $this->queryResponses[] = $class;
            }
        }
    }
}