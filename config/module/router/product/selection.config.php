<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/selection'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'resource' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/:id',
                'constraints' => array( 'id' => '[0-9]+' )
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'update' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'put',
                        'defaults' => array(
                            'controller' => 'HcbStoreProduct-Controller-Selection-Update'
                        )
                    )
                ),
                'show' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'get',
                        'defaults' => array(
                            'controller' => 'HcbStoreProduct-Controller-Selection-View'
                        )
                    )
                ),
                'images' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/images'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array (
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Selection-Image-List'
                                )
                            )
                        )
                    )
                )
            )
        ),
        'delete' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/delete'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'delete' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'HcbStoreProduct-Controller-Selection-Collection-Delete'
                        )
                    )
                )
            )
        ),
        'list' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'get'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'show' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' => 'HcbStoreProduct-Controller-Selection-Collection-List'
                        )
                    )
                )
            )
        ),
        'create' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'post',
                'defaults' => array(
                    'controller' => 'HcbStoreProduct-Controller-Selection-Create'
                )
            )
        )
    )
);
