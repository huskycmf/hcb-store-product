<?php
namespace HcbStoreProduct\Data;

use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;

class Localized extends InputFilter implements LocalizedInterface, DataMessagesInterface
{
    /**
     * @param Request $request
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                Extractor $dataExtractor,
                                Di $di)
    {
        /* @var $input \HcBackend\InputFilter\Input\Locale */
        $input = $di->get('HcBackend\InputFilter\Input\Locale',
                          array('name' => 'lang'))
                    ->setRequired(true);
        $this->add($input);

        $this->add(array('type'=>'HcBackend\InputFilter\Page'), 'page');

        $this->add(array( 'name' => 'description', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'title', 'required' => true, 'allowEmpty' => false,
                         'validators' => array(array( 'name' => 'string_length',
                                                      'options' => array(
                                                        'min' => 1,
                                                        'max' => 300
                                                      ))),
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'shortDescription', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'extraDescription', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array( 'name' => 'status', 'required' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'price', 'required' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'priceDeal', 'required' => false, 'allowEmpty' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->setData($dataExtractor->extract($request));
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
        return $this->getValue('page')['pageUrl'];
    }
}
