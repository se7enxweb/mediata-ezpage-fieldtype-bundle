<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\FieldType\Page;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService as BasePageService;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;
use Ibexa\Core\Base\Exceptions\UnauthorizedException;

class PageService extends BasePageService
{
    /**
     * Returns valid block items as content objects.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     *
     * @return \Ibexa\Contracts\Core\Repository\Values\Content\ContentInfo[]
     */
    public function getValidBlockItemsAsContentInfo(Block $block)
    {
        $contentInfoObjects = [];
        foreach ($this->getValidBlockItems($block) as $item) {
            try {
                $contentInfoObjects[] = $this->contentService->loadContentInfo($item->contentId);
            } catch (UnauthorizedException $e) {
                // If unauthorized, disregard block as "valid" and continue loading other blocks.
            }
        }

        return $contentInfoObjects;
    }

    /**
     * Returns the template to use for given layout.
     * If template is a legacy one (*.tpl) and does not begin with "design:" (like usually configured in legacy ezflow),
     * then add the appropriate prefix ("design:zone/", like in ezpage.tpl legacy template).
     *
     * @param string $layoutIdentifier
     *
     * @return string
     */
    public function getLayoutTemplate($layoutIdentifier)
    {
        $template = parent::getLayoutTemplate($layoutIdentifier);
        if (strpos($template, '.tpl') !== false && strpos($template, 'design:') === false) {
            $template = "design:zone/$template";
        }

        return $template;
    }
}
