<?php

return [
    'paths' => [
        "/service" => [
            "post" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "add service",
                "description" => "add service",
                "operationId" => "add service",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in" => "body",
                        "name" => "body",
                        "description" => "level_of_knowledge must be beginner/intermediate/expert",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/mentor_skill"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "get service",
                "description" => "get service",
                "operationId" => "get service",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "id",
                        "in" => "query",
                        "description" => "id",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/service/{id}" => [
            "delete" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "delete service",
                "description" => "delete service",
                "operationId" => "delete service",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "id",
                        "in" => "query",
                        "description" => "id",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/availability" => [
            "post" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "add schedule",
                "description" => "add schedule",
                "operationId" => "add schedule",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in" => "body",
                        "name" => "body",
                        "description" => "time will in 24 hour format and date should be yyyy-mm-dd format and meeting_place will be public/user_home/mentor_home",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/add_schedule"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "get schedule",
                "description" => "get schedule",
                "operationId" => "get schedule",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "id",
                        "in" => "query",
                        "description" => "",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
//        "/availability/{id}" => [
//		
//           "delete" => [
//                "tags" => [
//                    "mentor"
//                ],
//                "summary" => "delete schedule",
//                "description" => "delete schedule",
//                "operationId" => "delete schedule",
//                "consumes" => [
//                    "application/json"
//                ],
//                "produces" => [
//                    "application/json"
//                ],
//                "parameters" => [
//                       [
//                        "name" => "access-token",
//                        "in" => "header",
//                        "description" => "Access Token",
//                        "required" => true,
//                        "type" => "string",
//                        "format" => "int64"
//                    ],
//                       [
//                        "name" => "id",
//                        "in" => "path",
//                        "description" => "",
//                        "required" => true,
//                        "type" => "string",
//                        "format" => "int64"
//                    ],
//                   
//                ],
//                "responses" => [
//                ]
//            ]
//			
//        ],
        "/offer" => [
            "post" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "Add offer",
                "description" => "Add offer",
                "operationId" => "offer-post",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in" => "body",
                        "name" => "body",
                        "description" => "",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/offer-post"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Get offer",
                "description" => "Get offer",
                "operationId" => "offer-get",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/portfolio" => [
            "post" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "Add portfolio",
                "description" => "Add portfolio",
                "operationId" => "post-portfolio",
                "consumes" => [
                    "multipart/form-data"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "links[]",
                        "in" => "formData",
                        "description" => "Select image",
                        "required" => false,
                        "type" => 'file',
                    ],
                    [
                        "name" => "bio",
                        "in" => "formData",
                        "description" => "bio",
                        "required" => false,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "ids[]",
                        "in" => "formData",
                        "description" => "delete ids",
                        "required" => false,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "Get portfolio",
                "description" => "Get portfolio",
                "operationId" => "Get-portfolio",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/my-earning" => [
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "my earning",
                "description" => "my earning",
                "operationId" => "my earning",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "date",
                        "in" => "query",
                        "description" => "date will yyyy-mm-dd",
                        "required" => false,
                        "type" => "string",
                    ],
                    [
                        "name" => "status",
                        "in" => "query",
                        "description" => "status will be succeeded/pending/failed",
                        "required" => false,
                        "type" => "string",
                    ],
                    [
                        "name" => "transaction_id",
                        "in" => "query",
                        "description" => "transaction_id",
                        "required" => false,
                        "type" => "string",
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/mentor-home" => [
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "mentor home",
                "description" => "mentor home",
                "operationId" => "mentor home",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/users" => [
            "get" => [
                "tags" => [
                    "mentor"
                ],
                "summary" => "explor users",
                "description" => "explor users",
                "operationId" => "explor users",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "name" => "access-token",
                        "in" => "header",
                        "description" => "Access Token",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
    ],
    'definitions' => [
        'rating' => [
            'type' => "object",
            'properties' => [
                'from_id' => [
                    'type' => 'string'
                ],
                'to_id' => [
                    'type' => 'string'
                ],
                'rating' => [
                    'type' => 'string'
                ],
                'reviews' => [
                    'type' => 'string'
                ],
                'appointment_id' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "rating"
            ]
        ],
        'add_schedule' => [
            'type' => "object",
            'properties' => [
                'from_date' => [
                    'type' => 'string'
                ],
                'to_date' => [
                    'type' => 'string'
                ],
                'from_time' => [
                    'type' => 'string'
                ],
                'to_time' => [
                    'type' => 'string'
                ],
                'state' => [
                    'type' => 'string'
                ],
                'city' => [
                    'type' => 'string'
                ],
                'address' => [
                    'type' => 'string'
                ],
                'meeting_place' => [
                    'type' => 'string'
                ],
                'category_id' => [
                    'type' => 'string'
                ],
                'service_id' => [
                    'type' => 'string'
                ],
                'latitude' => [
                    'type' => 'string'
                ],
                'longitude' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "resend_code"
            ]
        ],
        'edit_schedule' => [
            'type' => "object",
            'properties' => [
                'id' => [
                    'type' => 'string'
                ],
                'from_date' => [
                    'type' => 'string'
                ],
                'to_date' => [
                    'type' => 'string'
                ],
                'from_time' => [
                    'type' => 'string'
                ],
                'to_time' => [
                    'type' => 'string'
                ],
                'state' => [
                    'type' => 'string'
                ],
                'city' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "resend_code"
            ]
        ],
        'reset_password' => [
            'type' => "object",
            'properties' => [
                'code' => [
                    'type' => 'string'
                ],
                'password' => [
                    'type' => 'string'
                ],
                'confirm_password' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "reset_password"
            ]
        ],
        'mentor_skill' => [
            'type' => "object",
            'properties' => [
                'skills' => [
                    'type' => 'array',
                    'items' => ['$ref' => '#/definitions/inner_param']
                ]
            ],
            'xml' => [
                'name' => "Add skill"
            ]
        ],
        'inner_param' => [
            'type' => "object",
            'properties' => [
                'category_id' => ['type' => 'number'],
                'service_id' => ['type' => 'number'],
                'exp_year' => ['type' => 'number'],
                'exp_month' => ['type' => 'number'],
                'amount' => ['type' => 'number'],
                'level_of_knowledge' => ['type' => 'string'],
            ]
        ],
        'offer-post' => [
            'type' => "object",
            'properties' => [
                'to_id' => [
                    'type' => 'integer'
                ],
                'category_id' => [
                    'type' => 'integer'
                ],
                'service_id' => [
                    'type' => 'integer'
                ],
                'date_time' => [
                    'type' => 'string'
                ],
                'price' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "rating"
            ]
        ],
    ]
];
