<?php
return array (
    'HcbStoreProduct-Data-Localized' => array (
        'parameters' => array (
            'resourceInputLoaderFromTextDescription' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-Description',
            'resourceInputLoaderFromTextExtraDescription' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-ExtraDescription',
            'productData' => 'HcbStoreProduct-Data-Product'
        )
    ),
    'HcbStoreProduct-Data-Product' => array (
        'parameters' => array (
            'resourceInputImageLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Image',
            'resourceInputThumbnailLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Thumbnail',
            'resourceInputImage3dLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Image3d'
        )
    ),

    'HcbStoreProduct-Data-Collection-Entities-ByIds-Product' => array (
        'parameters' => array (
            'idsCollection' => 'HcbStoreProduct-Service-Collection-IdsService-Product',
            'inputName' => 'products'
        )
    ),

    // Selection

    'HcbStoreProduct-Data-Selection' => array (
        'parameters' => array (
            'resourceInputImageLoader' =>
                'HcbStoreProduct-Data-InputCreateResourceInput-Selection-Image'
        )
    ),

    'HcbStoreProduct-Data-Collection-Entities-ByIds-Selection' => array (
        'parameters' => array (
            'idsCollection' => 'HcbStoreProduct-Service-Collection-IdsService-Selection',
            'inputName' => 'selections'
        )
    ),
);
