<?php
return array(
    'HcbStoreProduct-Data-Localized' => array(
        'parameters' => array(
//            'resourceInputContentLoader' =>
//                'HcbStoreProduct-Uploader-Input-Image-LoadResource-FromText-Content'
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
