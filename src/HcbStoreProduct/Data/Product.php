<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\ImageInterface;
use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;
use Zf2FileUploader\Input\Image\LoadResourceInterface;


class Product extends InputFilter implements ImageInterface, DataMessagesInterface
{
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
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                LoadResourceInterface $resourceInputImageLoader,
                                LoadResourceInterface $resourceInputThumbnailLoader,
                                LoadResourceInterface $resourceInputImage3dLoader,
                                Extractor $dataExtractor,
                                Di $di)
    {
        $this->resourceInputImageLoader = $resourceInputImageLoader;
        $this->resourceInputThumbnailLoader = $resourceInputThumbnailLoader;
        $this->resourceInputImage3dLoader = $resourceInputImage3dLoader;

        $this->add($resourceInputImageLoader);
        $this->add($resourceInputImage3dLoader);
        $this->add($resourceInputThumbnailLoader);

        $this->setData($dataExtractor->extract($request));
    }

    /**
     * @return \Zf2FileUploader\Resource\ImageResourceInterface[]
     */
    public function getResources()
    {
        $data = $this->resourceInputImageLoader->getResources();

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
}
