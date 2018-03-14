<?php

require_once("Autoloader.php");

/**
 * Example schema to be accepted via JSON input
 */
$_payLoadSchema = [
    [
        'node' => [
            'name' => 'title',
            'type' => 'text',
            'required' => true,
            'max_length' => 20
        ]
    ],
    [
        'node' => [
            'name' => 'action',
            'type' => 'text',
            'required' => true,
            'max_length' => 20,
            'choices' => [
                "CUSTOMER_DATA",
                "CUSTOMER_CREATE"
            ]
        ]
    ],
    [
        'node' => [
            'name' => 'transaction_amount',
            'type' => 'numeric',
            'required' => true,
            'value_range' => [
                'min_value' => 10,
                'max_value' => 100
            ]
        ]
    ],
    [
        'node' => [
            'name' => 'transaction_date',
            'type' => 'choices',
            'required' => true,
            'choices' => [
                "2018-01-01",
                "2018-01-02"
            ]
        ]
    ],
    [
        'node' => [
            'name' => 'customer_ids',
            'type' => 'array',
            'required' => true,
            'max_item_count' => 2
        ]
    ],
    [
        'node' => [
            'name' => 'is_active',
            'type' => 'boolean',
            'required' => false
        ]
    ],
    [
        'node' => [
            'name' => 'additional_data',
            'type' => 'object',
            'sub_nodes' => [
                ['node' => [
                        'name' => 'additional_field_1',
                        'type' => 'text',
                        'max_length' => "100"
                    ]],
                ['node' => [
                        'name' => 'additional_field_2',
                        'type' => 'numeric'
                    ]]
            ]
        ]
    ]
];


/**
 * example JSON input
 */
$json_raw = '
{
  "title": "",
  "action": "CUSTOMER_CREATE",
  "transaction_amount": "44",
  "transaction_date": "2018-01-01",
  "customer_ids": [
    1001,
    1002,
    1003
  ],
  "is_active": true,
  "additional_data": {
    "additional_field_2": 10
  }
}    
';

use JSONSchema\JsonSchemaValidator;

$jsonschemavalidator = new JsonSchemaValidator();
try {
    $jsonschemavalidator->validateSchema($_payLoadSchema, $json_raw);
} catch (Exception $e) {
    echo $e->getMessage();
}

print_r($jsonschemavalidator->getErrors());


?>