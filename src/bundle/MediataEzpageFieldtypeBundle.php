<?php

namespace MediataCom\MediataEzpageFieldtypeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MediataCom\MediataEzpageFieldtypeBundle\DependencyInjection\Configuration\Parser\Page;

class MediataEzpageFieldtypeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $eZExtension = $container->getExtension('ibexa');
        $eZExtension->addConfigParser(new Page());
        $eZExtension->addDefaultSettings(__DIR__ . '/Resources/config', ['default_settings.yaml']);     
    }
}
