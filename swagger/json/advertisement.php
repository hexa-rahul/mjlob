<?php

return [
    'paths' => [
        "/addAds" => [
            "post" => [
                "tags" => [
                    "advertisement"
                ],
                "summary"     => "add new advertisements",
                "description" => "add new advertisements",
                "operationId" => "add new advertisements",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "X-localization",
                        "in"   => "header",
                        "description" => "X-localization(ar/en)",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "api-key",
                        "in"   => "header",
                        "description" => "api-key",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "version",
                        "in"   => "header",
                        "description" => "version",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "category_id",
                        "description" => "category_id",
                        "required"    => true,
                        "type"        => 'int',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "name",
                        "description" => "name",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "reference_id",
                        "description" => "reference_id",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "prize",
                        "description" => "prize",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "size",
                        "description" => "size",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "type",
                        "description" => "type",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "google_map_link",
                        "description" => "google_map_link",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "address",
                        "description" => "address",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "country",
                        "description" => "country",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "is_promoted",
                        "description" => "is_promoted",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                     [
                        "in"          => "formData",
                        "name"        => "is_published",
                        "description" => "is_published",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                     [
                        "in"          => "formData",
                        "name"        => "latitude",
                        "description" => "latitude",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                     [
                        "in"          => "formData",
                        "name"        => "longitude",
                        "description" => "longitude",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "colors",
                        "description" => "colors",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "is_terms_condition_accepted",
                        "description" => "is_terms_condition_accepted",
                        "required"    => false,
                        "type"        => 'string',
                    ],

                    
                ],
                "responses" => [
                ]
            ],
            
        ],
        "/getAdvertisements" => [
            "get" => [
                "tags" => [
                    "advertisement"
                ],
                "summary"     => "Get Advertisements",
                "description" => "Get Advertisements",
                "operationId" => "Get Advertisements",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "X-localization",
                        "in"   => "header",
                        "description" => "X-localization(ar/en)",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "api-key",
                        "in"   => "header",
                        "description" => "api-key",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "version",
                        "in"   => "header",
                        "description" => "version",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                   
                ],
                "responses" => [
                ]
            ],
            
        ],
        "/advertisementDetail" => [
            "post" => [
                "tags" => [
                    "advertisement"
                ],
                "summary"     => "Advertisement Detail",
                "description" => "Advertisement Detail",
                "operationId" => "Advertisement Detail",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                     [
                        "name" => "X-localization",
                        "in"   => "header",
                        "description" => "X-localization(ar/en)",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "api-key",
                        "in"   => "header",
                        "description" => "api-key",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "version",
                        "in"   => "header",
                        "description" => "version",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "advertisement_id",
                        "description" => "advertisement_id",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/deleteAds" => [
            "delete" => [
                "tags" => [
                    "advertisement"
                ],
                "summary"     => "Delete Ads",
                "description" => "Delete Ads",
                "operationId" => "Delete Ads",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                     [
                        "name" => "X-localization",
                        "in"   => "header",
                        "description" => "X-localization(ar/en)",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "api-key",
                        "in"   => "header",
                        "description" => "api-key",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "version",
                        "in"   => "header",
                        "description" => "version",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "advertisement_id",
                        "description" => "advertisement_id",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                ],
                "responses" => [
                ]
            ],
            
        ],
        
    ],
    'definitions' => [
      
    ]
];
