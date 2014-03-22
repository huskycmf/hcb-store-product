<?php
return array(
    'HcbStoreProduct-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Page'
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

    'HcbStoreProduct-Controller-Locale-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Locale',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Locale',
            'serviceCommand' => 'HcbStoreProduct-Service-Locale-UpdateCommand',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Locale-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProduct-Data-Locale',
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Page',
            'serviceCommand' => 'HcbStoreProduct-Service-Locale-CreateCommand',
            'jsonResponseModelFactory' => 'HcbStoreProduct-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProduct-Controller-Locale-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProduct-Service-FetchService-Page',
            'paginatorDataFetchService' => 'HcbStoreProduct-Service-Locale-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProduct-Paginator-ViewModel-JsonModel-Locale'
        )
    ),

    'HcbStoreProduct-Controller-Locale-Image-Create' => array(
        'parameters' => array(
            'saveService' => 'HcBackend-Images-Default-SaveService',
            'uploaderModel' => 'HcbStoreProduct-Uploader-View-Model-UploaderModel-Locale-Image',
            'createResourceData' => 'HcbStoreProduct-Uploader-InputFilter-Image-CreateResource-Locale'
        )
    ),
);
