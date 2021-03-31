<?php

return [
    'paths' => [
        "/getNotifications" => [
            "get" => [
                "tags" => [
                    "notification"
                ],
                "summary"     => "Notification list",
                "description" => "Notification list",
                "operationId" => "Notification list",
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
        "/deleteNotification" => [
            "delete" => [
                "tags" => [
                    "notification"
                ],
                "summary"     => "Clear all notifications",
                "description" => "Clear all notifications",
                "operationId" => "Clear all notifications",
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
        
    ],
    'definitions' => [ ]
];
