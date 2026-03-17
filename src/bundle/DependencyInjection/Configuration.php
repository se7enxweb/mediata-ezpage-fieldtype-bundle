<?php

namespace MediataCom\MediataEzpageFieldtypeBundle\DependencyInjection;

use Ibexa\Bundle\Core\DependencyInjection\Configuration\ParserInterface;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\Suggestion\Collector\SuggestionCollectorInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration extends SiteAccessConfiguration
{

    /** @var \Ibexa\Bundle\Core\DependencyInjection\Configuration\ParserInterface */
    private $mainSiteAccessConfigParser;

    /** @var \Ibexa\Bundle\Core\DependencyInjection\Configuration\Suggestion\Collector\SuggestionCollectorInterface */
    private $suggestionCollector;

    public function __construct(
        ParserInterface $mainConfigParser,
        SuggestionCollectorInterface $suggestionCollector
    ) {
        $this->mainSiteAccessConfigParser = $mainConfigParser;
        $this->suggestionCollector = $suggestionCollector;
    }
    
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('mediata_page');
        $rootNode = $treeBuilder->getRootNode();

        $this->addPageSection($rootNode);

        // Delegate SiteAccess config to configuration parsers
        //$this->mainSiteAccessConfigParser->addSemanticConfig($this->generateScopeBaseNode($rootNode));

        return $treeBuilder;
    }

    public function addPageSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('ezpage')
            ->info('List of globally registered layouts and blocks used by the Page fieldtype')
            ->children()
            ->arrayNode('layouts')
            ->info('List of registered layouts, the key is the identifier of the layout')
            ->useAttributeAsKey('key')
            ->normalizeKeys(false)
            ->prototype('array')
            ->children()
            ->scalarNode('name')->isRequired()->info('Name of the layout')->end()
            ->scalarNode('template')->isRequired()->info('Template to use to render this layout')->end()
            ->end()
            ->end()
            ->end()
            ->arrayNode('blocks')
            ->info('List of registered blocks, the key is the identifier of the block')
            ->useAttributeAsKey('key')
            ->normalizeKeys(false)
            ->prototype('array')
            ->children()
            ->scalarNode('name')->isRequired()->info('Name of the block')->end()
            ->end()
            ->end()
            ->end()
            ->arrayNode('enabledBlocks')
            ->prototype('scalar')
            ->end()
            ->info('List of enabled blocks by default')
            ->end()
            ->arrayNode('enabledLayouts')
            ->prototype('scalar')
            ->end()
            ->info('List of enabled layouts by default')
            ->end()
            ->end()
            ->end()
            ->end();
    }

    public function setSiteAccessConfigurationFilters(array $filters)
    {
        $this->siteAccessConfigurationFilters = $filters;
    }
}