<?php

return [
    'paths' => [
        "/country-list" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "country list",
                "description" => "country list",
                "operationId" => "country list",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                ],
                "responses" => [
                ]
            ]
        ],
        "/state-list" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "state list",
                "description" => "state list",
                "operationId" => "state list",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "in" => "query",
                        "name" => "country_id",
                        "description" => "",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/city-list" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "city list",
                "description" => "city list",
                "operationId" => "city list",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "in" => "query",
                        "name" => "state_id",
                        "description" => "",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/update-profile" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Update profile",
                "description" => "Update user profile",
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
                        "in" => "formData",
                        "name" => "first_name",
                        "description" => "Enter first name",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "last_name",
                        "description" => "Enter last name",
                        "required" => false,
                        "type" => 'string',
                    ],
                    /* [
                      "in" => "formData",
                      "name" => "email",
                      "description" => "Enter email id",
                      "required" => true,
                      "type" => 'string',
                      ], */
                    [
                        "in" => "formData",
                        "name" => "phone_number",
                        "description" => "Enter mobile model",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "date_of_birth",
                        "description" => "dob should be in yyyy-mm-dd format",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "address",
                        "description" => "address",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "country",
                        "description" => "country_id",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "state",
                        "description" => "state_id",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "city",
                        "description" => "city",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "bio",
                        "description" => "bio",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "parent_name",
                        "description" => "parent name",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "parent_email",
                        "description" => "parent email",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "profile_image",
                        "description" => "Select image",
                        "required" => false,
                        "type" => 'file',
                    ]
                ],
                "responses" => [
                    "default" => [
                        "description" => "successful operation"
                    ]
                ]
            ]
        ],
        "/user-detail" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Logout User",
                "description" => "",
                "consumes" => [
                    "application/json"
                ], "parameters" => [
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
                        "description" => "user_id",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                    "405" => [
                        "description" => "Invalid input"
                    ]
                ],
            ],
        ],
        "/complaints" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Save Complaints",
                "description" => "Save Complaints",
                "operationId" => "post-complaints",
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
                        "description" => "block will be yes/no",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/post-complaints"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/verify-with" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "verify-with",
                "description" => "",
                "operationId" => "verify-with",
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
                        "description" => "you will send yes/no",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/verify-with"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/contact-us" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "contact-us",
                "description" => "",
                "operationId" => "contact-us",
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
                            '$ref' => "#/definitions/contact-us"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/appointment" => [
            "post" => [
                "tags" => [
                    "user"
                ],
                "summary" => "Add appointment",
                "description" => "date - 'yyyy-mm-dd'",
                "operationId" => "post",
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
                            '$ref' => "#/definitions/appointment-post"
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
                "summary" => "Get appointment",
                "description" => "Get appointment",
                "operationId" => "get",
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
                        "in" => "query",
                        "name" => "type",
                        "description" => "Type",
                        "type" => "string",
                        "enum" => ["on_going", "upcomming", "past"],
                        "required" => true
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/appointment/{id}" => [
            "put" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Update appointment",
                "description" => "date - 'yyyy-mm-dd' | meeting_place - 'public','user_home','mentor_home' | level_of_knowledge - 'beginner','intermediate','expert'",
                "operationId" => "put",
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
                        "description" => "Appointment ID",
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
                            '$ref' => "#/definitions/appointment-update"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/appointment-detail/{id}" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "appointment detail",
                "description" => "",
                "operationId" => "put",
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
                        "in" => "path",
                        "description" => "Appointment ID",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                 
                ],
                "responses" => [
                ]
            ],
           
        ],
        "/faq" => [
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "faq list",
                "description" => "faq list",
                "operationId" => "faq list",
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
        "/appointment-cancel-complete/{id}" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "update appointment status",
                "description" => "update appointment status",
                "operationId" => "update appointment status",
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
                        "description" => "Appointment ID",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "status",
                        "in" => "query",
                        "description" => "status will be cancelled/complete",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
           
        ],
        "/rating" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Login a user",
                "description" => "Login for User",
                "operationId" => "login",
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
                            '$ref' => "#/definitions/rating"
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
                "summary" => "Get rating",
                "description" => "Get rating",
                "operationId" => "get",
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
                        "description" => "user_id",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/change-password" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "changes password",
                "description" => "",
                "operationId" => "changes password",
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
                            '$ref' => "#/definitions/change-password"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/post" => [
            "post" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Add Post",
                "description" => "Add Post",
                "operationId" => "post",
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
                        "name" => "appointment_id",
                        "in" => "formData",
                        "description" => "Appointment Id",
                        "required" => true,
                        "type" => "integer",
                        "format" => "int64"
                    ],
                    [
                        "name" => "to_id",
                        "in" => "formData",
                        "description" => "User Id",
                        "required" => true,
                        "type" => "integer",
                        "format" => "int64"
                    ],
                    [
                        "name" => "comment",
                        "in" => "formData",
                        "description" => "Post Comment",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "images[]",
                        "in" => "formData",
                        "description" => "Select image",
                        "required" => false,
                        "type" => "file",
                    ],
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "common"
                ],
                "summary" => "Get appointment",
                "description" => "Get appointment",
                "operationId" => "get",
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
                        "description" => "user_id",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
    ],
    'definitions' => [
        'post-complaints' => [
            'type' => "object",
            'properties' => [
                'user_id' => [
                    'type' => 'integer'
                ],
                'comments' => [
                    'type' => 'string'
                ],
                'block' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "Login"
            ]
        ],
        'contact-us' => [
            'type' => "object",
            'properties' => [
                'name' => [
                    'type' => 'string'
                ],
                'type' => [
                    'type' => 'string'
                ],
                'comments' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "Login"
            ]
        ],
        'verify-with' => [
            'type' => "object",
            'properties' => [
                'verify_facebook' => [
                    'type' => 'string'
                ],
                'verify_twitter' => [
                    'type' => 'string'
                ],
                'verify_youtube' => [
                    'type' => 'string'
                ],
                'verify_pinterest' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "Login"
            ]
        ],
        'change-password' => [
            'type' => "object",
            'properties' => [
                'current_password' => [
                    'type' => 'string'
                ],
                'new_password' => [
                    'type' => 'string'
                ],
                'confirm_password' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "Login"
            ]
        ],
        'appointment-post' => [
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
                'date' => [
                    'type' => 'string'
                ],
                'from_time_slot' => [
                    'type' => 'string'
                ],
                'to_time_slot' => [
                    'type' => 'string'
                ],
//                'meeting_place' => [
//                    'type' => 'string'
//                ],
//                'meeting_address' => [
//                    'type' => 'string'
//                ],
//                'level_of_knowledge' => [
//                    'type' => 'string'
//                ],
                'description' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "appointment"
            ]
        ],
        'appointment-update' => [
            'type' => "object",
            'properties' => [
                'date' => [
                    'type' => 'string'
                ],
                'time' => [
                    'type' => 'string'
                ],
//                'meeting_address' => [
//                    'type' => 'string'
//                ],
//                'level_of_knowledge' => [
//                    'type' => 'string'
//                ],
//                'description' => [
//                    'type' => 'string'
//                ]
            ],
            'xml' => [
                'name' => "appointment"
            ]
        ],
    ]
];
