<?php
return array(
    'router' => include __DIR__ . '/module/router.config.php',
    'di' => include __DIR__ . '/module/di.config.php',

    'doctrine' => array(
        'driver' => array(
            'app_driver' => array(
                'paths' => array(__DIR__ . '/../src/HcbStoreProduct/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'HcbStoreProduct\Entity' => 'app_driver'
                )
            )
        )
    ),

    'hcb-store-product' => array(
//        'statuses' => array(
//            '1' => 'product_status_1',
//            '2' => 'product_status_2',
//            '3' => 'product_status_3',
//            '4' => 'product_status_4'
//        )
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'HcbStoreProduct' => __DIR__ . '/../public',
            )
        )
    ),

    'hc-backend'=> array(
        'packages' => array(
            'hcb-store-product' => array(
                'js'=>array(
                    'type'=>'content',
                    'http_path'=>'/js/src/hcb-store-product'
                )
            )
        )
    )
);
