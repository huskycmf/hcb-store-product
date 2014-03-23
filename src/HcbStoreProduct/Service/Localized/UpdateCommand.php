<?php
namespace HcbStoreProduct\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\ResponseInterface;

class UpdateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var UpdateService
     */
    protected $service;

    public function __construct(LocalizedInterface $localizedData,
                                UpdateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param \HcCore\Entity\EntityInterface|\HcbStoreProduct\Entity\Product\Localized $productLocalizedEntity
     *
     * @return ResponseInterface
     */
    public function execute(EntityInterface $productLocalizedEntity)
    {
        return $this->service->update($productLocalizedEntity, $this->localizedData);
    }
}
