<?php
namespace HcbStoreProduct\Data;

use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;
use Zf2FileUploader\Input\Image\LoadResourceInterface;


class Localized extends InputFilter implements LocalizedInterface, DataMessagesInterface
{
    /**
     * @var LoadResourceInterface
     */
    protected $resourceInputLoaderFromTextExtraDescription;
    /**
     * @var LoadResourceInterface
     */
    protected $resourceInputLoaderFromTextDescription;

    /**
     * @var Product
     */
    protected $productData;

    /**
     * @param Request $request
     * @param LoadResourceInterface $resourceInputLoaderFromTextDescription
     * @param LoadResourceInterface $resourceInputLoaderFromTextExtraDescription
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                LoadResourceInterface
                                    $resourceInputLoaderFromTextDescription,
                                LoadResourceInterface
                                    $resourceInputLoaderFromTextExtraDescription,
                                Extractor $dataExtractor,
                                Product $productData,
                                Di $di)
    {

        $this->productData = $productData;

        $this->resourceInputLoaderFromTextExtraDescription =
            $resourceInputLoaderFromTextExtraDescription;

        $this->resourceInputLoaderFromTextDescription =
            $resourceInputLoaderFromTextDescription;

        /* @var $input \HcBackend\InputFilter\Input\Locale */
        $input = $di->get('HcBackend\InputFilter\Input\Locale',
                          array('name' => 'lang'))
                    ->setRequired(true);
        $this->add($input);

        $this->add(array('type'=>'HcBackend\InputFilter\Page'), 'page');

        $this->add(array( 'name' => 'title', 'required' => true, 'allowEmpty' => false,
                         'validators' => array(array( 'name' => 'string_length',
                                                      'options' => array(
                                                        'min' => 1,
                                                        'max' => 300
                                                      ))),
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'shortDescription', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'status', 'required' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'replaceProduct', 'required' => false,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'price', 'required' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'characteristics[]', 'required' => false));

        $this->add(array( 'name' => 'priceDeal', 'required' => false, 'allowEmpty' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $resourceInputLoaderFromTextExtraDescription->setAllowEmpty(true);
        $this->add($resourceInputLoaderFromTextExtraDescription);

        $this->add(array( 'name' => 'extraDescription',
                          'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $resourceInputLoaderFromTextDescription->setAllowEmpty(true);
        $this->add($resourceInputLoaderFromTextDescription);

        $this->add(array( 'name' => 'description', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->setData($dataExtractor->extract($request));

        $this->add($productData, 'product');
    }

    /**
     * @return Product
     */
    public function getProductData()
    {
        return $this->productData;
    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface[]
     */
    public function getResources()
    {
        $data = array_merge($this->resourceInputLoaderFromTextExtraDescription->getResources(),
                            $this->resourceInputLoaderFromTextDescription->getResources());
        return $data;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getValue('description');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->getValue('price');
    }

    /**
     * @return string
     */
    public function getPriceDeal()
    {
        return $this->getValue('priceDeal');
    }

    /**
     * @return number
     */
    public function getReplaceProductId()
    {
        return $this->getValue('replaceProduct');
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->getValue('shortDescription');
    }

    /**
     * @return string
     */
    public function getExtraDescription()
    {
        return $this->getValue('extraDescription');
    }

    /**
     * @return number
     */
    public function getStatus()
    {
        return $this->getValue('status');
    }

    /**
     * @return array
     */
    public function getCharacteristic()
    {
        return $this->getValue('characteristics[]');
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getValue('lang');
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->getValue('page')['pageDescription'];
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->getValue('page')['pageKeywords'];
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->getValue('page')['pageTitle'];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '';
    }
}
