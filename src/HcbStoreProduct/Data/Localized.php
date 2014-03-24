<?php
namespace HcbStoreProduct\Data;

use HcCore\Data\DataMessagesInterface;
use Zend\InputFilter\CollectionInputFilter;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use HcCore\InputFilter\InputFilter;
use Zend\Validator\Callback;

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
                          array('name' => 'locale'))->setRequired(true);
        $this->add($input);

        $this->add(array('type'=>'HcBackend\InputFilter\Page'), 'page');

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'content'))
                    ->setRequired(false)
                    ->setAllowEmpty(true);

        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        $this->setData($dataExtractor->extract($request));
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getValue('content');
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getValue('locale');
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
