<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'store' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/store'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'product' => include __DIR__ . '/router/product.config.php'
                    )
                )
            )
        )
    )
);
