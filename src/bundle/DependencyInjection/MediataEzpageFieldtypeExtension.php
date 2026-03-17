<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\DependencyInjection;

use Ibexa\Bundle\Core\DependencyInjection\Configuration\RepositoryConfigParser;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\RepositoryConfigParserInterface;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\SiteAccessAware\ConfigurationProcessor;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\Suggestion\Collector\SuggestionCollector;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Yaml\Yaml;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\Suggestion\Collector\SuggestionCollectorAwareInterface;
use MediataCom\MediataEzpageFieldtypeBundle\DependencyInjection\Configuration\Parser\Page;

class MediataEzpageFieldtypeExtension extends Extension implements PrependExtensionInterface
{
    /** @var \Ibexa\Bundle\Core\DependencyInjection\Configuration\Suggestion\Collector\SuggestionCollector */
    private $suggestionCollector;

    /** @var \Ibexa\Bundle\Core\DependencyInjection\Configuration\ParserInterface[] */
    private $siteAccessConfigParsers;

    /** @var \Ibexa\Bundle\Core\DependencyInjection\Configuration\RepositoryConfigParserInterface[] */
    private $repositoryConfigParsers = [];
    
    public function __construct(array $siteAccessConfigParsers = [], array $repositoryConfigParsers = [])
    {
        $this->siteAccessConfigParsers = $siteAccessConfigParsers;
        $this->repositoryConfigParsers = $repositoryConfigParsers;
        $this->suggestionCollector = new SuggestionCollector();
    }
    
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config/')
        );

        /*$configuration = $this->getConfiguration($configs, $container);

        // Note: this is where the transformation occurs
        $config = $this->processConfiguration($configuration, $configs);*/

        $loader->load('field_value_converters.yaml');
        $loader->load('fieldtype_form_mappers.yaml');
        $loader->load('fieldtype_services.yaml');
        $loader->load('fieldtypes.yaml');
        $loader->load('services.yaml');
        $loader->load('templating.yaml');
        $loader->load('view.yaml');
        //$loader->load('default_settings.yaml');

        /*// Map settings
        $processor = new ConfigurationProcessor($container, 'mediata_page');
        //$processor->mapConfig($config, $this->getMainConfigParser());
        $processor->mapConfig($config);*/
    }

    /**
     * @return \Ibexa\Bundle\Core\DependencyInjection\Configuration\ParserInterface
     */
    /*private function getMainConfigParser()
    {
        if ($this->mainConfigParser === null) {
            foreach ($this->siteAccessConfigParsers as $parser) {
                if ($parser instanceof SuggestionCollectorAwareInterface) {
                    $parser->setSuggestionCollector($this->suggestionCollector);
                }
            }

            $this->mainConfigParser = new Page($this->siteAccessConfigParsers);
        }

        return $this->mainConfigParser;
    }*/

    /**
     * @param array $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return \Ibexa\Bundle\Core\DependencyInjection\Configuration
     */
    /*public function getConfiguration(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration(
            $this->getMainConfigParser(),
            $this->suggestionCollector
        );

        //$configuration->setSiteAccessConfigurationFilters($this->siteaccessConfigurationFilters);

        return $configuration;
    }*/

    public function prepend(ContainerBuilder $container): void
    {
    }
}