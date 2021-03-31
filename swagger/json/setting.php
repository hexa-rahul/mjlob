<?php

return [
    'paths' => [
        "/appSetting" => [
            "get" => [
                "tags" => [
                    "setting"
                ],
                "summary"     => "App Setting",
                "description" => "App Setting",
                "operationId" => "App Setting",
                "consumes" => [
                    "application/json"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                  
                    [
                        "name" => "api-key",
                        "in"   => "header",
                        "description" => "api-key",
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
    ]
];
