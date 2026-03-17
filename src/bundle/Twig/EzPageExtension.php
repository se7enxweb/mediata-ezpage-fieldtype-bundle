<?php

namespace MediataCom\MediataEzpageFieldtypeBundle\Twig;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EzPageExtension extends AbstractExtension
{
    private PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ezpage_valid_block_items', [$this, 'getValidBlockItems']),
        ];
    }

    /**
     * Returns valid (published) block items, falling back to waiting items when
     * the eZ Flow cron has not yet run (ts_visible = 0). This is expected in a
     * pure Ibexa 4 context where the legacy publish cron is not active.
     */
    public function getValidBlockItems(Block $block): array
    {
        $items = $this->pageService->getValidBlockItems($block);

        if (empty($items)) {
            $items = $this->pageService->getWaitingBlockItems($block);
        }

        return $items;
    }
}
