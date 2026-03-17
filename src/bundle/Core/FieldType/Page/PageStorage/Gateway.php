<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageStorage;

use Ibexa\Contracts\Core\FieldType\StorageGateway;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block;

/**
 * Main abstract storage gateway for Page field type.
 */
abstract class Gateway extends StorageGateway
{
    /**
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Item[]
     */
    abstract public function getValidBlockItems(Block $block);

    /**
     * Returns the block item having a highest visible date, for given block.
     * Will return null if no block item is registered for block.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block $block
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Item|null
     */
    abstract public function getLastValidBlockItem(Block $block);

    /**
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Item[]
     */
    abstract public function getWaitingBlockItems(Block $block);

    /**
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Block
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Item[]
     */
    abstract public function getArchivedBlockItems(Block $block);

    /**
     * Returns Content id for the given Block $id,
     * or false if Block could not be found.
     *
     * @throws \Ibexa\Contracts\Core\Repository\Exceptions\NotFoundException If block could not be found.
     *
     * @param int|string $id
     *
     * @return int|string
     */
    abstract public function getContentIdByBlockId($id);
}
