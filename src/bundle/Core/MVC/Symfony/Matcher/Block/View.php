<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\Matcher\Block;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View\BlockValueView;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View\View as ViewObject;

class View extends MultipleValued
{
    /**
     * Checks if a Block object matches.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     *
     * @return bool
     */
    public function matchBlock(Block $block)
    {
        return isset($this->values[$block->view]);
    }

    public function match(ViewObject $view)
    {
        if (!$view instanceof BlockValueView) {
            return false;
        }

        return isset($this->values[$view->getBlock()->view]);
    }
}
