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
     * @var LoadResourceInterface
     */
    protected $resourceInputImageLoader;
    /**
     * @var LoadResourceInterface
     */
    protected $resourceInputThumbnailLoader;
    /**
     * @var LoadResourceInterface
     */
    protected $resourceInputImage3dLoader;

    /**
     * @param Request $request
     * @param LoadResourceInterface $resourceInputImageLoader
     * @param LoadResourceInterface $resourceInputThumbnailLoader
     * @param LoadResourceInterface $resourceInputImage3dLoader
     * @param LoadResourceInterface $resourceInputLoaderFromTextDescription
     * @param LoadResourceInterface $resourceInputLoaderFromTextExtraDescription
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                LoadResourceInterface $resourceInputImageLoader,
                                LoadResourceInterface $resourceInputThumbnailLoader,
                                LoadResourceInterface $resourceInputImage3dLoader,
                                LoadResourceInterface $resourceInputLoaderFromTextDescription,
                                LoadResourceInterface $resourceInputLoaderFromTextExtraDescription,
                                Extractor $dataExtractor,
                                Di $di)
    {
        $this->resourceInputLoaderFromTextExtraDescription =
            $resourceInputLoaderFromTextExtraDescription;

        $this->resourceInputLoaderFromTextDescription =
            $resourceInputLoaderFromTextDescription;

        $this->resourceInputImageLoader = $resourceInputImageLoader;
        $this->resourceInputThumbnailLoader = $resourceInputThumbnailLoader;
        $this->resourceInputImage3dLoader = $resourceInputImage3dLoader;

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

        $this->add(array( 'name' => 'price', 'required' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $this->add(array( 'name' => 'priceDeal', 'required' => false, 'allowEmpty' => true,
                          'validators' => array(array( 'name' => 'digits'))));

        $resourceInputLoaderFromTextExtraDescription->setAllowEmpty(true);
        $this->add($resourceInputLoaderFromTextExtraDescription);

        $this->add(array( 'name' => 'extraDescription',
                          'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $resourceInputLoaderFromTextDescription->setAllowEmpty(true);
        $this->add($resourceInputLoaderFromTextDescription);

        $this->add($resourceInputImageLoader);
        $this->add($resourceInputImage3dLoader);
        $this->add($resourceInputThumbnailLoader);

        $this->add(array( 'name' => 'description', 'required' => false, 'allowEmpty' => true,
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->setData($dataExtractor->extract($request));

    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface[]
     */
    public function getResources()
    {
        $data = array_merge($this->resourceInputLoaderFromTextExtraDescription->getResources(),
                            $this->resourceInputLoaderFromTextDescription->getResources(),
                            $this->resourceInputImageLoader->getResources());

        $thumbnailImage = $this->getThumbnail();
        if (!empty($thumbnailImage)) {
            array_push($data, $this->getThumbnail());
        }
        return $data;
    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface
     */
    public function getThumbnail()
    {
        return current($this->resourceInputThumbnailLoader->getResources());
    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface
     */
    public function getImage3d()
    {
        return current($this->resourceInputImage3dLoader->getResources());
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
