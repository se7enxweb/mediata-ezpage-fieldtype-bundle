<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\View;

use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;
use Ibexa\Core\MVC\Symfony\View\BaseView;
use Ibexa\Core\MVC\Symfony\View\View;
use Ibexa\Core\MVC\Symfony\View\CachableView;

class BlockView extends BaseView implements View, BlockValueView, CachableView
{
    /** @var Block */
    private $block;

    public function __construct($templateIdentifier = null, array $parameters = [])
    {
        parent::__construct($templateIdentifier, $parameters, 'block');
    }

    /**
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     */
    public function setBlock(Block $block)
    {
        $this->block = $block;
    }

    /**
     * Returns the Content.
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block
     */
    public function getBlock()
    {
        return $this->block;
    }

    protected function getInternalParameters()
    {
        return ['block' => $this->block];
    }
}
