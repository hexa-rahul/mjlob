<?php

return [
    'paths' => [
        "/getProducts" => [
            "post" => [
                "tags" => [
                    "product"
                ],
                "summary"     => "Product List",
                "description" => "Product List",
                "operationId" => "Product List",
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
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ]
            
        ],
        "/likeUnliked" => [
            "post" => [
                "tags" => [
                    "product"
                ],
                "summary"     => "Like / Unlike Product",
                "description" => "Like / Unlike Product",
                "operationId" => "Like / Unlike Product",
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
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "product_id",
                        "description" => "product_id",
                        "required"    => true,
                        "type"        => 'number',
                    ],

                ],
                "responses" => [
                ]
            ]
            
        ],
         "/getFavourite" => [
            "post" => [
                "tags" => [
                    "product"
                ],
                "summary"     => "Get Favourite List",
                "description" => "Get Favourite List",
                "operationId" => "Get Favourite List",
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
                        "name" => "Authorization",
                        "in"   => "header",
                        "description" => "Authorization",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ]
            
        ]
    ],
    'definitions' => [ ]
];
