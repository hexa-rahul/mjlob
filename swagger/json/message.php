<?php

return [
    'paths' => [
        "/sendMessage" => [
            "post" => [
                "tags" => [
                    "message"
                ],
                "summary"     => "Send Message",
                "description" => "Send Message",
                "operationId" => "Send Message",
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
                        "name"        => "receiverId",
                        "description" => "receiverId",
                        "required"    => true,
                        "type"        => 'number',
                    ],
                    [
                        "in" => "formData",
                        "name" => "message",
                        "description" => "Message",
                        "required" => true,
                        "type" => 'string',
                    ]
                ],
                "responses" => []
            ]
            
        ],
        "/chatUserList" => [
            "post" => [
                "tags" => [
                    "message"
                ],
                "summary"     => "Chat User List",
                "description" => "Chat User List",
                "operationId" => "Chat User List",
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
        "/getMessageListByUser" => [
            "post" => [
                "tags" => [
                    "message"
                ],
                "summary"     => "Get Message List By User",
                "description" => "Get Message List By User",
                "operationId" => "Get Message List By User",
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
            
        ]
    ],
    'definitions' => [ ]
];
