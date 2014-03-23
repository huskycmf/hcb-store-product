<?php
return array(
    'HcbStoreProduct-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Product'
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
            'inputData' => 'HcbStoreProduct-Data-Collection-Entities-ByIds-Page',
            'serviceCommand' => 'HcbStoreProduct-Service-Collection-Delete',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
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

    'HcbStoreProduct-Controller-Localized-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Page',
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Localized-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Localized'
        )
    ),

    'HcbStoreProduct-Controller-Localized-Image-Create' => array(
        'parameters' => array(
            'saveService' => 'HcBackend-Images-Default-SaveService',
            'uploaderModel' => 'HcbStoreProduct-Uploader-View-Model-UploaderModel-Localized-Image',
            'createResourceData' => 'HcbStoreProduct-Uploader-InputFilter-Image-CreateResource-Localized'
        )
    ),
);
