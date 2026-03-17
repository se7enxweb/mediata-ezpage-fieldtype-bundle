<?php

namespace MediataCom\MediataEzpageFieldtypeBundle\View;

use Ibexa\Contracts\Core\Repository\Repository;
use Ibexa\Contracts\Core\SiteAccess\ConfigResolverInterface;
use Ibexa\Core\MVC\Symfony\View\Manager as BaseManager;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View\BlockView;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig\Environment;
use RuntimeException;

class Manager extends BaseManager
{
    /**
     * @var array Array indexed by priority.
     *            Each priority key is an array of Block View Provider objects having this priority.
     *            The highest priority number is the highest priority
     */
    protected $blockViewProviders = [];

    /** @var \MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\View\Provider\Block[] */
    protected $sortedBlockViewProviders;

    /** @var \Ibexa\Core\MVC\Symfony\View\Configurator */
    private $viewConfigurator;

    public function __construct(
        Environment $templateEngine,
        EventDispatcherInterface $eventDispatcher,
        Repository $repository,
        ConfigResolverInterface $configResolver,
        $viewBaseLayout,
        $viewConfigurator,
        LoggerInterface $logger = null
    )
    {
        parent::__construct($templateEngine,
            $eventDispatcher,
            $repository,
            $configResolver,
            $viewBaseLayout,
            $viewConfigurator,
            $logger);

        $this->viewConfigurator = $viewConfigurator;
    }
    
    
    /**
     * Helper for {@see addContentViewProvider()} and {@see addLocationViewProvider()}.
     *
     * @param array $property
     * @param \Ibexa\Core\MVC\Symfony\View\ViewProvider $viewProvider
     * @param int $priority
     */
    private function addViewProvider(&$property, $viewProvider, $priority)
    {
        $priority = (int)$priority;
        if (!isset($property[$priority])) {
            $property[$priority] = [];
        }

        $property[$priority][] = $viewProvider;
    }
    
    /**
     * Registers $viewProvider as a valid location view provider.
     * When this view provider will be called in the chain depends on $priority. The highest $priority is, the earliest the router will be called.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\View\Provider\Block $viewProvider
     * @param int $priority
     */
    public function addBlockViewProvider(ViewProvider $viewProvider, $priority = 0)
    {
        $this->addViewProvider($this->blockViewProviders, $viewProvider, $priority);
    }

    /**
     * Sort the registered view providers by priority.
     * The highest priority number is the highest priority (reverse sorting).
     *
     * @param array $property view providers to sort
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\View\Provider\Block[]
     */
    protected function sortBlockViewProviders($property)
    {
        $sortedViewProviders = [];
        krsort($property);

        foreach ($property as $viewProvider) {
            $sortedViewProviders = array_merge($sortedViewProviders, $viewProvider);
        }

        return $sortedViewProviders;
    }

    /**
     * @return \Ibexa\Core\MVC\Symfony\View\ViewProvider[]
     */
    public function getAllBlockViewProviders()
    {
        if (empty($this->sortedBlockViewProviders)) {
            $this->sortedBlockViewProviders = $this->sortBlockViewProviders($this->blockViewProviders);
        }

        return $this->sortedBlockViewProviders;
    }

    /**
     * Renders $block by selecting the right template.
     * $block will be injected in the selected template.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     * @param array $parameters Parameters to pass to the template called to
     *        render the view. By default, it's empty.
     *        'block' entry is reserved for the Block that is viewed.
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function renderBlock(Block $block, $parameters = [])
    {
        $view = new BlockView(null, $parameters);
        $view->setBlock($block);

        $this->viewConfigurator->configure($view);

        if ($view->getTemplateIdentifier() === null) {
            throw new RuntimeException("Unable to find a view for location #$block->id");
        }

        return $this->renderContentView($view);
    }
}