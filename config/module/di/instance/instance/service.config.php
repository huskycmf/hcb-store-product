<?php
return array(
    'HcbStoreProduct-Service-FetchService-Product' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct\Entity\Product'
        )
    ),

    'HcbStoreProduct-Service-FetchService-Localized' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct\Entity\Product\Localized'
        )
    ),

    'HcbStoreProduct-Service-Collection-IdsService-Product' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct\Entity\Product'
        )
    ),

    'HcbStoreProduct-Service-Collection-Delete' => array(
        'parameters' => array(
            'deleteData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Product'
        )
    ),

    // Selection
    'HcbStoreProduct-Service-FetchService-Selection' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct\Entity\Product\Selection'
        )
    ),

    'HcbStoreProduct-Service-Collection-IdsService-Selection' => array(
        'parameters' => array(
            'entityName' => 'HcbStoreProduct\Entity\Product\Selection'
        )
    ),

    'HcbStoreProduct-Service-Selection-Collection-Delete' => array(
        'parameters' => array(
            'deleteData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Selection'
        )
    ),
);
