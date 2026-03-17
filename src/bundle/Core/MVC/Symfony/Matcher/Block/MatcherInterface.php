<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\Matcher\Block;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;
use MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\Matcher\ViewMatcherInterface as BaseMatcherInterface;

/**
 * Main interface for block matchers.
 */
interface MatcherInterface extends BaseMatcherInterface
{
    /**
     * Checks if a Block object matches.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     *
     * @return bool
     */
    public function matchBlock(Block $block);
}
