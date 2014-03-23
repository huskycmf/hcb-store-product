<?php
namespace HcbStoreProduct\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use HcbStoreProduct\Entity\Product as ProductEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var CreateService
     */
    protected $service;

    /**
     * @param LocalizedInterface $localizedData
     * @param CreateService $service
     */
    public function __construct(LocalizedInterface $localizedData,
                                CreateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param ProductEntity $productEntity
     *
     * @return Response
     */
    public function execute(EntityInterface $productEntity)
    {
        return $this->service->save($productEntity, $this->localizedData);
    }
}
