<?php
return array(
    'HcbStoreProduct-Uploader-Input-Image-LoadResource-FromText-Description' => array(
        'parameters' => array( 'name' => 'description' )
    ),

    'HcbStoreProduct-Uploader-Input-Image-LoadResource-FromText-Instruction' => array(
        'parameters' => array( 'name' => 'extraDescription' )
    ),

    // Product Uploads
    'HcbStoreProduct-Uploader-Input-Image-CreateResource' => array(
        'parameters' => array(
            'name' => 'upload'
        )
    ),
    'HcbStoreProduct-Uploader-InputFilter-Image-CreateResource' => array(
        'parameters' => array(
            'resourceInput' => 'HcbStoreProduct-Uploader-Input-Image-CreateResource'
        )
    )
);
