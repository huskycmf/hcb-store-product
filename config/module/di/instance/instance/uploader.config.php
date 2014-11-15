<?php
return array(
    'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-Description' => array(
        'parameters' => array( 'name' => 'description' )
    ),

    'HcbStoreProduct-Data-InputCreateResourceInput-LoadResource-FromText-ExtraDescription' => array(
        'parameters' => array( 'name' => 'extraDescription' )
    ),

    'HcbStoreProduct-Data-InputCreateResourceInput-Image' => array(
        'parameters' => array( 'name' => 'image' )
    ),

    'HcbStoreProduct-Data-InputCreateResourceInput-Thumbnail' => array(
        'parameters' => array( 'name' => 'thumbnail' )
    ),

    'HcbStoreProduct-Data-InputCreateResourceInput-Image3d' => array(
        'parameters' => array( 'name' => 'image3d' )
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
