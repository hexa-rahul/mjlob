<?php

return [
    'paths' => [
        "/connect-account" => [
            "post" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Create connect account",
                "description" => "Create connect account",
                "operationId" => "connect-account",
                "consumes" => [
                    "multipart/form-data"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                   
//                    [
//                        "in" => "formData",
//                        "name" => "email",
//                        "description" => "Email",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
//                    [
//                        "in" => "formData",
//                        "name" => "first_name",
//                        "description" => "First Name",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
//                    [
//                        "in" => "formData",
//                        "name" => "last_name",
//                        "description" => "Last Name",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
//                    [
//                        "in" => "formData",
//                        "name" => "dob",
//                        "description" => "Date of Birth",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
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
                        "name" => "account_holder_name",
                        "description" => "Account Holder Name",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "routing_number",
                        "description" => "Routing Number",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "account_number",
                        "description" => "Account Number",
                        "required" => true,
                        "type" => 'string',
                    ],
                 
//                    [
//                        "in" => "formData",
//                        "name" => "city",
//                        "description" => "City",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
//                    [
//                        "in" => "formData",
//                        "name" => "address",
//                        "description" => "Address",
//                        "required" => true,
//                        "type" => 'string',
//                    ],
                    [
                        "in" => "formData",
                        "name" => "ssn_number",
                        "description" => "ssn_number",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "postal_code",
                        "description" => "Postal Code",
                        "required" => true,
                        "type" => 'string',
                    ],
                    [
                        "in" => "formData",
                        "name" => "personal_id",
                        "description" => "Personal Id",
                        "required" => true,
                        "type" => 'file',
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/connect-account/{account_id}" => [
            "delete" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Delete connect account",
                "description" => "Delete connect account",
                "operationId" => "delete-connect-account",
                "consumes" => [
                    "multipart/form-data"
                ],
                "produces" => [
                    "application/json"
                ],
                "parameters" => [
                    [
                        "in" => "query",
                        "name" => "account_id",
                        "description" => "Account ID",
                        "required" => true,
                        "type" => 'string',
                    ],
                ],
                "responses" => [
                ]
            ],
        ],
        "/card" => [
            "post" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Add stripe card",
                "description" => "Add stripe card",
                "operationId" => "add-stripe-card",
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
                            '$ref' => "#/definitions/add-stripe-card"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
            "get" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Get stripe card",
                "description" => "Get stripe card",
                "operationId" => "get-stripe-card",
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
        "/card/{card_id}" => [
            "delete" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Delete stripe card",
                "description" => "Delete stripe card",
                "operationId" => "delete-stripe-card",
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
                        "name" => "card_id",
                        "in" => "path",
                        "description" => "Card ID",
                        "required" => true,
                        "type" => "string",
                        "format" => "int64"
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/payment" => [
            "post" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Appointment payment",
                "description" => "Appointment payment",
                "operationId" => "payment",
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
                        "required" => true,
                        "schema" => [
                            '$ref' => "#/definitions/payment"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/refund" => [
            "post" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Refund payment",
                "description" => "Refund payment",
                "operationId" => "refund",
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
                        "required" => true,
                        "schema" => [
                            '$ref' => "#/definitions/refund"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
        ],
        "/transactions" => [
            "get" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "All Transactions",
                "description" => "All Transactions",
                "operationId" => "transactions",
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
//        "/payment-complete" => [
//            "post" => [
//                "tags" => [
//                    "transaction"
//                ],
//                "summary" => "Complete Payment",
//                "description" => "Complete Payment",
//                "operationId" => "payment-complete",
//                "consumes" => [
//                    "multipart/form-data"
//                ],
//                "produces" => [
//                    "application/json"
//                ],
//                "parameters" => [
//                    [
//                        "name" => "access-token",
//                        "in" => "header",
//                        "description" => "Access Token",
//                        "required" => true,
//                        "type" => "string",
//                        "format" => "int64"
//                    ],
//                    [
//                        "in" => "formData",
//                        "name" => "transaction_id",
//                        "description" => "Transaction ID",
//                        "required" => true,
//                        "type" => "string",
//                    ]
//                ],
//                "responses" => [
//                ]
//            ],
//        ],
        "/payment-transfer" => [
            "post" => [
                "tags" => [
                    "transaction"
                ],
                "summary" => "Payment transfer",
                "description" => "Payment transfer",
                "operationId" => "Payment transfer",
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
                        "required" => true,
                        "schema" => [
                            '$ref' => "#/definitions/payment_transfer_param"
                        ]
                    ]
                ],
                "responses" => [
                ]
            ],
        ]
    ],
    'definitions' => [
        'add-stripe-card' => [
            'type' => "object",
            'properties' => [
                'card_number' => [
                    'type' => 'string'
                ],
                'expiry_month' => [
                    'type' => 'string'
                ],
                'expiry_year' => [
                    'type' => 'string'
                ],
                'cvv' => [
                    'type' => 'string'
                ],
            ],
            'xml' => [
                'name' => "Add Stripe Card"
            ]
        ],
        'payment' => [
            'type' => "object",
            'properties' => [
                'mentor_id' => [
                    'type' => 'string'
                ],
                'appointment_id' => [
                    'type' => 'string'
                ],
                'amount' => [
                    'type' => 'string'
                ],
                'card_id' => [
                    'type' => 'string'
                ],
            ],
            'xml' => [
                'name' => "Payment"
            ]
        ],
        'refund' => [
            'type' => "object",
            'properties' => [
                'transaction_id' => [
                    'type' => 'string'
                ],
                'amount' => [
                    'type' => 'string'
                ],
            ],
            'xml' => [
                'name' => "Payment"
            ]
        ],
        
        'payment_transfer_param' => [
            'type' => "object",
            'properties' => [
                'amount' => [
                    'type' => 'string'
                ],
                'mentor_id' => [
                    'type' => 'string'
                ],
                'appointment_id' => [
                    'type' => 'string'
                ]
            ],
            'xml' => [
                'name' => "payment"
            ]
        ],
    ]
];
