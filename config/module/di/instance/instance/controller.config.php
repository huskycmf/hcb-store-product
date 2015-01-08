<?php
return array(

    // Product

    'HcbStoreProduct-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Product'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Characteristic-Collection' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbStoreProduct\Service\Localized\Characteristic\Collection\FetchQbBuilderService',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Localized-Characteristic'
        )
    ),

    'HcbStoreProduct-Controller-Attribute-Collection' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbStoreProduct\Service\Attribute\Collection\FetchQbBuilderService',
            'viewModel' =>
                'HcbStoreProduct-Paginator-ViewModel-JsonModel-Attribute'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Characteristic-Value-Collection' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbStoreProduct\Service\Localized\Characteristic\Value\Collection\FetchQbBuilderService',
            'viewModel' =>
                'HcbStoreProduct-Paginator-ViewModel-JsonModel-Localized-Characteristic-Value'
        )
    ),

    'HcbStoreProduct-Controller-View' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product',
            'extractor' => 'HcbStoreProduct-Stdlib-Extractor-Resource'
        )
    ),

    'HcbStoreProduct-Controller-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbStoreProduct-Service-Create',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Product',
            'serviceCommand' => 'HcbStoreProduct-Service-Collection-Delete',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    // Localized
    'HcbStoreProduct-Controller-Localized-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product',
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Localized-Collection-FetchArrayCollection',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Localized'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Localized',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Localized',
            'serviceCommand' => 'HcbStoreProduct-Service-Localized-UpdateCommand',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Localized',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product',
            'serviceCommand' => 'HcbStoreProduct-Service-Localized-CreateCommand',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    // Product Image
    'HcbStoreProduct-Controller-Image-Create' => array(
        'parameters' => array(
            'saveService' => 'HcBackend-Service-Image-SaveService',
            'uploaderModel' => 'HcbStoreProduct-Uploader-View-Model-UploaderModel-Image',
            'createResourceData' => 'HcbStoreProduct-Uploader-InputFilter-Image-CreateResource'
        )
    ),

    // Product Thumbnail
    'HcbStoreProduct-Controller-Thumbnail-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product'
        )
    ),

    // Product Image 3D
    'HcbStoreProduct-Controller-Image3d-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product'
        )
    ),

    'HcbStoreProduct-Controller-Image-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product'
        )
    ),
);
