<?php
namespace HcbStoreProduct\Service\Locale;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbStoreProduct\Data\LocaleInterface;
use HcbStoreProduct\Entity\StaticPage;
use Zf2Libs\Stdlib\Service\Response\Messages\ResponseInterface;

class UpdateCommand implements ResourceCommandInterface
{
    /**
     * @var LocaleInterface
     */
    protected $localeData;

    /**
     * @var UpdateService
     */
    protected $service;

    public function __construct(LocaleInterface $localeData,
                                UpdateService $service)
    {
        $this->localeData = $localeData;
        $this->service = $service;
    }

    /**
     * @param \HcCore\Entity\EntityInterface|\HcbStoreProduct\Entity\StaticPage\Locale $postDataEntity
     *
     * @return ResponseInterface
     */
    public function execute(EntityInterface $postDataEntity)
    {
        return $this->service->update($postDataEntity, $this->localeData);
    }
}
