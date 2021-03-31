<?php

return [
    'paths' => [
        "/contactUs" => [
            "post" => [
                "tags" => [
                    "contact"
                ],
                "summary"     => "Contact Us",
                "description" => "Contact US",
                "operationId" => "Contact US",
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
                        "name"        => "mobile_number",
                        "description" => "Enter Mobile Number",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "message",
                        "description" => "message",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                   
                ],
                "responses" => [
                ]
            ],
            
        ],
    ],
    'definitions' => [ ]
];
