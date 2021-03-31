<?php

return [
    'paths' => [
        
        "/registration" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "Registration profile",
                "description" => "Registration profile",
                "consumes" => [
                    "multipart/form-data"
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
                        "in"          => "formData",
                        "name"        => "username",
                        "description" => "Enter username",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "mobile_number",
                        "description" => "Enter mobile_number",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "location",
                        "description" => "Enter location",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "country_code",
                        "description" => "Enter country code",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "password",
                        "description" => "Enter password",
                        "required" => true,
                        "type" => 'string',
                    ],
                    // [
                    //     "in" => "formData",
                    //     "name" => "google_map_link",
                    //     "description" => "google_map_link",
                    //     "required" => false,
                    //     "type" => 'string',
                    // ],
                    [
                        "in" => "formData",
                        "name" => "device_token",
                        "description" => "device token",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "device_type",
                        "description" => "Device type",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "latitude",
                        "description" => "Latitude",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "longitude",
                        "description" => "Longitude",
                        "required" => false,
                        "type" => 'string',
                    ],
                    [
                        "in"       => "formData",
                        "name"     => "is_accepted_terms_condition",
                        "description" => "0=Not Accepted,1=Accepted",
                        "required" => false,
                        "type"     => 'string',
                    ]

                ],
                "responses" => [
                    "default" => [
                        "description" => "successful operation"
                    ]
                ]
            ]
        ],
        "/login" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary"     => "Login a user",
                "description" => "Login for User",
                "operationId" => "login",
                "consumes"    => [
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
                        "in"          => "formData",
                        "name"        => "mobile_number",
                        "description" => "Enter Mobile Number",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "password",
                        "description" => "Enter Password",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "device_type",
                        "description" => "Enter device type",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "device_token",
                        "description" => "Enter device token",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "latitude",
                        "description" => "Enter latitude",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "longitude",
                        "description" => "Enter longitude",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "login_type",
                        "description" => "manual/social",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "social_id",
                        "description" => "Enter social id",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "social_type",
                        "description" => "Enter social type",
                        "required"    => false,
                        "type"        => 'string',
                    ]
                   
                ],
                "responses" => [
                ]
            ]
        ],
        "/checkUser" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary"     => "Check User By Mobile Number",
                "description" => "Check User By Mobile Number",
                "operationId" => "Check User By Mobile Number",
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
                    [
                        "name" => "version",
                        "in"   => "header",
                        "description" => "version",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "name" => "X-localization",
                        "in"   => "header",
                        "description" => "X-localization(ar/en)",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "mobile_number",
                        "description" => "Enter Mobile Number",
                        "required"    => false,
                        "type"        => 'number',
                    ],
                ],
                "responses" => [
                ]
            ]
        ],
        "/verifyOtp" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "verify otp",
                "description" => "verify otp",
                "operationId" => "verify otp",
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
                        "in" => "formData",
                        "name" => "mobile_number",
                        "description" => "Enter mobile number",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "otp",
                        "description" => "Enter otp",
                        "required" => true,
                        "type" => 'string',
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/reset-password" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "reset password",
                "description" => "reset password",
                "operationId" => "reset password",
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
                        "in" => "formData",
                        "name" => "mobile_number",
                        "description" => "Enter mobile number",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "otp",
                        "description" => "Enter otp",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "password",
                        "description" => "Enter Password",
                        "required" => true,
                        "type" => 'string',
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/changePassword" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "change password",
                "description" => "change password",
                "operationId" => "change password",
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
                        "in" => "formData",
                        "name" => "current_password",
                        "description" => "Enter current password",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "new_password",
                        "description" => "Enter new password",
                        "required" => true,
                        "type" => 'string',
                    ]
                ],
                "responses" => [
                ]
            ]
        ],
        "/logout" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "Logout User",
                "description" => "",
                "consumes" => [
                    "application/json"
                ], "parameters" => [
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
                    "401" => [
                        "description" => "Invalid input"
                    ]
                ],
            ],
        ],
        "/getUserProfile" => [
            "get" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "User profile detail",
                "description" => "User profile detail",
                "consumes" => [
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
                    "401" => [
                        "description" => "Invalid input"
                    ]
                ],
            ],
        ],
        "/updateProfile" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "Update profile",
                "description" => "Update profile",
                "consumes" => [
                    "multipart/form-data"
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
                        "name"        => "full_name",
                        "description" => "Enter full name",
                        "required"    => true,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "google_map_link",
                        "description" => "Enter google map link",
                        "required"    => false,
                        "type"        => 'string',
                    ],
                    [
                        "in"          => "formData",
                        "name"        => "image",
                        "description" => "change profile image",
                        "required"    => false,
                        "type"        => 'file',
                    ],
                ],
                "responses" => [
                    "default" => [
                        "description" => "successful operation"
                    ]
                ]
            ]
        ],
        "/updateProfileImage" => [
            "post" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "Update profile image",
                "description" => "Update profile image",
                "consumes" => [
                    "multipart/form-data"
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
                        "name"        => "image",
                        "description" => "upload image",
                        "required"    => true,
                        "type"        => 'file',
                    ],
                ],
                "responses" => [
                    "default" => [
                        "description" => "successful operation"
                    ]
                ]
            ]
        ],
        "/selectLanguage" => [
            "get" => [
                "tags" => [
                    "profile"
                ],
                "summary" => "select User",
                "description" => "",
                "consumes" => [
                    "application/json"
                ], "parameters" => [
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
                    "401" => [
                        "description" => "Invalid input"
                    ]
                ],
            ],
        ],
    ],
    'definitions' => [
    
    ]
];
