<?php
return array(
    // Product
    'HcbStoreProduct-Controller-Collection-List' =>
        'HcCore\Controller\Common\Rest\Collection\ListController',

    'HcbStoreProduct-Controller-Create' =>
        'HcCore\Controller\Common\Rest\Collection\DataController',

    'HcbStoreProduct-Controller-Collection-Delete' =>
        'HcCore\Controller\Common\Rest\Collection\DataController',

    // Localized
    'HcbStoreProduct-Controller-Localized-Collection-List' =>
        'HcCore\Controller\Common\Rest\Collection\ResourceListController',

    'HcbStoreProduct-Controller-Localized-Update' =>
        'HcCore\Controller\Common\Rest\Collection\ResourceDataController',

    'HcbStoreProduct-Controller-Localized-Create' =>
        'HcCore\Controller\Common\Rest\Collection\ResourceDataController',

    // Localized Image
    'HcbStoreProduct-Controller-Localized-Image-Create' =>
        'Zf2FileUploader\Controller\Images\CreateController',

    'HcbStoreProduct-Controller-Localized-Image-List' =>
        'HcbStoreProduct\Controller\Images\ListController'
);
