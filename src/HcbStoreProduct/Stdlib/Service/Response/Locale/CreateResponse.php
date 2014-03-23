<?php
namespace HcbStoreProduct\Stdlib\Service\Response\Locale;

use Zf2Libs\Stdlib\Response\DataInterface;
use Zf2Libs\Stdlib\Service\Response\ResourceInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;
use HcbStoreProduct\Stdlib\Response\Exception\InvalidArgumentException;

class CreateResponse extends Response implements DataInterface, ResourceInterface
{
    /**
     * @var number
     */
    protected $localeId;

    /**
     * @param mixed $localeId
     */
    public function setResource($localeId)
    {
        if (!is_numeric($localeId)) {
            throw new InvalidArgumentException("Invalid type of locale id, must be numeric");
        }

        $this->localeId = $localeId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array('id'=>$this->localeId);
    }
}
