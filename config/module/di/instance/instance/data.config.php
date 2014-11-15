<?php
return array(
    'HcbStoreProduct-Data-Localized' => array(
        'parameters' => array(
            'resourceInputImageLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Image',
            'resourceInputThumbnailLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Thumbnail',
            'resourceInputImage3dLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Image3d',
            'resourceInputLoaderFromTextDescription' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-Description',
            'resourceInputLoaderFromTextExtraDescription' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-ExtraDescription',
            'entityManager' => 'Doctrine\ORM\EntityManager'
        )
    ),

    'HcbStoreProduct-Data-Collection-Entities-ByIds-Product' => array(
        'parameters' => array(
            'idsCollection' => 'HcbStoreProduct-Service-Collection-IdsService-Product',
            'inputName' => 'products'
        )
    )
);
