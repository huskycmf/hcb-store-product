<?php
namespace HcbStoreProduct\Service\Exception;

use HcCore\Service\Fetch\Paginator\Exception\InvalidResourceExceptionInterface;

class InvalidResourceException extends InvalidArgumentException implements InvalidResourceExceptionInterface {}
