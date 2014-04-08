<?php
namespace HcbStoreProduct\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * @var array
     */
    protected $statuses;

    /**
     * @param array $statuses
     */
    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
}
