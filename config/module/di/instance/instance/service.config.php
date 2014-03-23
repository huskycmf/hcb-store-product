<?php
return array(
    'HcbStoreProduct-Service-FetchService-Product' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct-Entity-Product'
        )
    ),

    'HcbStoreProduct-Service-FetchService-Localized' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct-Entity-Product-Localized'
        )
    ),

    'HcbStoreProduct-Service-Collection-IdsService-Product' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct-Entity-Product'
        )
    ),

    'HcbStoreProduct-Service-Collection-Delete' => array(
        'parameters' => array(
            'deleteData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Product'
        )
    ),

    // Uploader

    'HcbStoreProduct-Uploader-Input-Image-LoadResource-FromText-Content' => array(
        'parameters' => array( 'name' => 'content' )
    ),

    'HcbStoreProduct-Uploader-Input-Image-CreateResource-Localized' => array(
        'parameters' => array(
            'name' => 'upload'
        )
    ),

    'HcbStoreProduct-Uploader-InputFilter-Image-CreateResource-Localized' => array(
        'parameters' => array(
            'resourceInput' => 'HcbStoreProduct-Uploader-Input-Image-CreateResource-Localized'
        )
    )
);
