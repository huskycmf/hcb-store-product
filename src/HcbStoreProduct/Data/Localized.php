<?php
namespace HcbStoreProduct\Data;

use HcBackend\InputFilter\LangTrait;
use HcBackend\InputFilter\PageTrait;

use HcCore\Data\DataMessagesInterface;
use Zend\InputFilter\InputFilter;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zend\Validator\Callback;
use Zf2FileUploader\Input\Image\LoadResourceInterface as LoadResourceInputInterface;

class Localized extends InputFilter implements LocalizedInterface, DataMessagesInterface
{ use PageTrait, LangTrait

    /**
     * @var LoadResourceInputInterface
     */
    protected $resourceInputContentLoader;

    public function __construct(Request $request,
                                Extractor $dataExtractor,
                                LoadResourceInputInterface $resourceInputContentLoader,
                                Di $di)
    {
        /* @var $inputFilter \HcBackend\InputFilter\Lang */
        $inputFilter = $di->get('HcBackend\InputFilter\Lang');
        $this->add($inputFilter);

        /* @var $inputFilter \HcBackend\InputFilter\Page */
        $inputFilter = $di->get('HcBackend\InputFilter\Page');
        $this->add($inputFilter);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'content'))
            ->setRequired(false)
            ->setAllowEmpty(true);
        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        $this->resourceInputContentLoader = $resourceInputContentLoader;
        $resourceInputContentLoader->setAllowEmpty(true);
        $this->add($resourceInputContentLoader);

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
     * @return ImageResourceInterface[]
     */
    public function getResources()
    {
        return $this->resourceInputContentLoader->getResources();
    }
}
