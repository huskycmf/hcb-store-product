<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/product'
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
                'image3d' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/image3d'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array (
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Image3d-List'
                                )
                            )
                        )
                    )
                ),
                'thumbnail' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/thumbnail'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array (
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Thumbnail-List'
                                )
                            )
                        )
                    )
                ),
                'image' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/images'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array (
                        'create' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'post',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Image-Create'
                                )
                            )
                        ),
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Image-List'
                                )
                            )
                        )
                    )
                ),
                'locale' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/localized'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' =>
                                        'HcbStoreProduct-Controller-Localized-Collection-List'
                                )
                            )
                        ),
                        'create' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'post',
                                'defaults' => array(
                                    'controller' => 'HcbStoreProduct-Controller-Localized-Create'
                                )
                            )
                        ),
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
                                            'controller' => 'HcbStoreProduct-Controller-Localized-Update'
                                        )
                                    )
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
                            'controller' => 'HcbStoreProduct-Controller-Collection-Delete'
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
                            'controller' => 'HcbStoreProduct-Controller-Collection-List'
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
                    'controller' => 'HcbStoreProduct-Controller-Create'
                )
            )
        )
    )
);
