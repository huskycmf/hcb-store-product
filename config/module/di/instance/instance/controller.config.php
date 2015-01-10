<?php
return array(

    // Selection

    'HcbStoreProduct-Controller-Selection-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Selection-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Selection'
        )
    ),

    'HcbStoreProduct-Controller-Selection-View' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Selection',
            'extractor' => 'HcbStoreProduct-Stdlib-Extractor-Selection-Resource'
        )
    ),

    'HcbStoreProduct-Controller-Selection-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbStoreProduct-Service-Selection-Create',
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory-Selection'
        )
    ),

    'HcbStoreProduct-Controller-Selection-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Selection',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Selection',
            'serviceCommand' => 'HcbStoreProduct-Service-Selection-Update',
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory-Selection'
        )
    ),

    'HcbStoreProduct-Controller-Selection-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Selection',
            'serviceCommand' => 'HcbStoreProduct-Service-Selection-Collection-Delete',
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory-Selection'
        )
    ),

    // Selection Image
    'HcbStoreProduct-Controller-Selection-Image-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Selection'
        )
    ),

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
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Product',
            'serviceCommand' => 'HcbStoreProduct-Service-Collection-Delete',
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory'
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
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Localized',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product',
            'serviceCommand' => 'HcbStoreProduct-Service-Localized-CreateCommand',
            'jsonResponseModelFactory' => 'HcbStoreProduct-ViewModel-StatusMessageDataModelFactory'
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

    // Product Image
    'HcbStoreProduct-Controller-Image-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Product'
        )
    )
);
