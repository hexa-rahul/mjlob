<?php

return [
    'paths' => [
        "/message" => [
            "post" => [
                "tags" => [
                    "chat"
                ],
                "summary" => "post message",
                "description" => "post message",
                "operationId" => "post message",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "in" => "body",
                        "name" => "body",
                        "description" => "",
                        "required" => false,
                        "schema" => [
                            '$ref' => "#/definitions/chat_param"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
            
        ],
        "/inbox" => [
            "get" => [
                "tags" => [
                    "chat"
                ],
                "summary" => "inbox list",
                "description" => "inbox list",
                "operationId" => "inbox list",
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
        "/chat-list" => [
            "get" => [
                "tags" => [
                    "chat"
                ],
                "summary" => "chat-list",
                "description" => "chat-list",
                "operationId" => "chat-list",
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
                        "name" => "to_id",
                        "in" => "query",
                        "description" => "to_id",
                        "required" => true,
                        "type" => "integer",
                        "format" => "int64"
                    ],
                   
                ],
                "responses" => [
                ]
            ],
            
        ],
        "/chat/{to_id}" => [
            "delete" => [
                "tags" => [
                    "chat"
                ],
                "summary" => "delete chat",
                "description" => "delete chat",
                "operationId" => "delete chat",
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
                        "in" => "path",
                        "name" => "to_id",
                        "description" => "",
                        "required" => true,
                        "type" => "integer",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
            
        ],
        
    ],
    'definitions' => [
        'chat_param' => [
            'type' => "object",
            'properties' => [
                'from_id' => [
                    'type' => 'string'
                ],
                'to_id' => [
                    'type' => 'string'
                ],
                'message' => [
                    'type' => 'string'
                ],
            ],
            'xml' => [
                'name' => "Login"
            ]
        ],
    ]
];
