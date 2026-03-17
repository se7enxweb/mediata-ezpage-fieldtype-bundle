<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;

interface BlockValueView
{
    /**
     * @return Block
     */
    public function getBlock();
}
