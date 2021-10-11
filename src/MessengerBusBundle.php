<?php

declare(strict_types=1);

namespace Oscmarb\MessengerBusBundle;

use Oscmarb\MessengerBusBundle\Compiler\MessageLoaderCompilerPass;
use Oscmarb\MessengerBusBundle\Compiler\MessageSerializerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MessengerBusBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new MessageLoaderCompilerPass());
        $container->addCompilerPass(new MessageSerializerCompilerPass());
    }
}