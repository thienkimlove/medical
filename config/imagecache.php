<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'image-cached',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('files/images')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation callbacks.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    */
   
    'templates' => array(

        '208x177' => function($image) {
            return $image->fit(208, 177);
        },
        '350x289' => function($image) {
            return $image->fit(350, 289);
        },
        '400x245' => function($image) {
            return $image->fit(400, 245);
        },
        '200x150' => function($image) {
            return $image->fit(200, 150);
        },
        '120x120' => function($image) {
            return $image->fit(120, 120);
        },
        '509x338' => function($image) {
            return $image->fit(509, 338);
        },
        '310x230' => function($image) {
            return $image->fit(310, 230);
        },
        '300x177' => function($image) {
            return $image->fit(300, 177);
        },
        '110x70' => function($image) {
            return $image->fit(110, 70);
        },
        '218x128' => function($image) {
            return $image->fit(218, 128);
        },

        '220x130' => function($image) {
            return $image->fit(220, 130);
        },
        '290x150' => function($image) {
            return $image->fit(290, 150);
        },
        '303x130' => function($image) {
            return $image->fit(303, 130);
        },
        '105x69' => function($image) {
            return $image->fit(105, 69);
        },

    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
