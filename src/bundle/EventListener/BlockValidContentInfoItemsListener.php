<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\EventListener;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService;
use MediataCom\MediataEzpageFieldtypeBundle\FieldType\Page\PageService as CoreBundlePageService;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View\BlockView;
use Ibexa\Core\MVC\Symfony\View\Event\FilterViewParametersEvent;
use Ibexa\Core\MVC\Symfony\View\ViewEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Injects valid ContentInfo items into the block view.
 */
class BlockValidContentInfoItemsListener implements EventSubscriberInterface
{
    /** @var PageService */
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public static function getSubscribedEvents()
    {
        return [ViewEvents::FILTER_VIEW_PARAMETERS => 'injectValidContentInfoItems'];
    }

    public function injectValidContentInfoItems(FilterViewParametersEvent $event)
    {
        $view = $event->getView();
        if ($view instanceof BlockView && $this->pageService instanceof CoreBundlePageService) {
            $event->getParameterBag()->set(
                'valid_contentinfo_items',
                $this->pageService->getValidBlockItemsAsContentInfo($view->getBlock())
            );
        }
    }
}
