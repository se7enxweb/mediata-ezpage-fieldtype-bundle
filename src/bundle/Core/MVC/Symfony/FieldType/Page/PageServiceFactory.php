<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace MediataCom\MediataEzpageFieldtypeBundle\Core\MVC\Symfony\FieldType\Page;

use Ibexa\Contracts\Core\SiteAccess\ConfigResolverInterface;
use MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageStorage\Gateway as PageGateway;
use Ibexa\Contracts\Core\Repository\ContentService;

class PageServiceFactory
{
    /**
     * Builds the page service.
     *
     * @param string $serviceClass the class of the page service
     * @param ConfigResolverInterface $resolver
     * @param \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageStorage\Gateway $storageGateway
     * @param \Ibexa\Contracts\Core\Repository\ContentService $contentService
     *
     * @return \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService
     */
    public function buildService(
        $serviceClass,
        ConfigResolverInterface $resolver,
        PageGateway $storageGateway,
        ContentService $contentService
    ) {
        $pageSettings = $resolver->getParameter('ezpage');
        /** @var $pageService \MediataCom\MediataEzpageFieldtypeBundle\Core\FieldType\Page\PageService */
        $pageService = new $serviceClass(
            $contentService,
            $pageSettings['layouts'],
            $pageSettings['blocks']
        );
        $pageService->setStorageGateway($storageGateway);

        return $pageService;
    }
}
