<?php
namespace HcbStoreProduct\Service;

use HcCore\Data\LocaleInterface;
use HcCore\Entity\LocaleBindInterface;
use HcCore\Stdlib\Service\Response\Locale\BindResponse;

class LocaleBinderService extends \HcCore\Service\LocaleBinderService
{

    /**
     * @param LocaleInterface $localeData
     * @param LocaleBindInterface $localeBind
     * @return BindResponse
     */
    public function bind(LocaleInterface $localeData, LocaleBindInterface $localeBind)
    {
        $repository = $this->entityManager->getRepository('HcCore\Entity\Locale');
        $localeEntity = $repository->findOneBy(array('locale'=>$localeData->getLocale()));
        
        if (is_null($localeEntity)) {
            return $this->bindResponse->localeDoesNotSupport();
        }

        $localeBind->setLocale($localeEntity);
        return $this->bindResponse->success();
    }
}
