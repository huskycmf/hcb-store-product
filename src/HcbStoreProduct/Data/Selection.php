<?php
namespace HcbStoreProduct\Data;

use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;
use Zf2FileUploader\Input\Image\LoadResourceInterface;


class Selection extends InputFilter implements SelectionInterface, DataMessagesInterface
{
    /**
     * @var LoadResourceInterface
     */
    protected $resourceInputImageLoader;

    /**
     * @param Request $request
     * @param LoadResourceInterface $resourceInputImageLoader
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                LoadResourceInterface $resourceInputImageLoader,
                                Extractor $dataExtractor,
                                Di $di)
    {
        $this->resourceInputImageLoader = $resourceInputImageLoader;

        $this->add(array( 'name' => 'price', 'required' => true, 'allowEmpty' => false,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'products[]', 'required' => true));

        $resourceInputImageLoader->setAllowEmpty(true)->setRequired(false);
        $this->add($resourceInputImageLoader);

        $this->setData($dataExtractor->extract($request));
    }

    /**
     * @return Product
     */
    public function getProducts()
    {
        return $this->getValue('products[]');
    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface[]
     */
    public function getResources()
    {
        return $this->resourceInputImageLoader->getResources();
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->getValue('price');
    }
}
