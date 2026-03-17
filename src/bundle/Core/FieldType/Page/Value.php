<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page;

use Ibexa\Core\FieldType\Value as BaseValue;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Page;

class Value extends BaseValue
{
    /**
     * Container for page definition.
     *
     * @var \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Page
     */
    public $page;

    /**
     * Construct a new Value object.
     *
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\Parts\Page $page
     */
    public function __construct(Page $page = null)
    {
        $this->page = $page;
    }

    /**
     * Returns a string representation of the field value.
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->page instanceof Page) {
            return (string)$this->page->layout;
        }

        return '';
    }
}
