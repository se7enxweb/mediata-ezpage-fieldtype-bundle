<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\FieldType\Page;

use eZ\Publish\Core\MVC\Symfony\FieldType\View\ParameterProviderInterface;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService;
use eZ\Publish\API\Repository\Values\Content\Field;



/**
 * View parameter provider for Page fieldtype.
 */
class ParameterProvider implements ParameterProviderInterface
{
    /** @var \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService */
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function getViewParameters(Field $field)
    {
        return [
            'pageService' => $this->pageService,
        ];
    }
}
