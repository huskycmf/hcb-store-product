<?php
return array(
    'HcbStoreProduct-Data-Localized' => array(
        'parameters' => array(
            'resourceInputImageLoader' => 'HcbStoreProduct-Data-InputCreateResourceInput-Image',
            'entityManager' => 'Doctrine\ORM\EntityManager'
        )
    ),

    'HcbStoreProduct-Data-InputCreateResourceInput-Image' => array(
        'parameters' => array( 'name' => 'image' )
    ),

    'HcbStoreProduct-Data-Collection-Entities-ByIds-Product' => array(
        'parameters' => array(
            'idsCollection' => 'HcbStoreProduct-Service-Collection-IdsService-Product',
            'inputName' => 'products'
        )
    )
);
