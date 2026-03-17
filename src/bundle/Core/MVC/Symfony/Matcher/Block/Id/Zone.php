<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\Matcher\Block\Id;

use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\Matcher\Block\MultipleValued;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block as PageBlock;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View\BlockValueView;
use Ibexa\Core\MVC\Symfony\View\View;

class Zone extends MultipleValued
{
    /**
     * Checks if a Block object matches.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     *
     * @return bool
     */
    public function matchBlock(PageBlock $block)
    {
        return isset($this->values[$block->zoneId]);
    }

    public function match(View $view)
    {
        if (!$view instanceof BlockValueView) {
            return false;
        }

        return isset($this->values[$view->getBlock()->zoneId]);
    }
}
