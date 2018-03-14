# JSON Schema Validator


This class validates JSON payloads by using predefined schema based on basic necessary data types.
Data types validation can be extended by creating new classes and new constraints can be added by writing new functions in Constraints class.

This schema validator works on following types:

- text
- numeric
- date
- array
- boolean
- choices

## Constraints:

- max_length (string length)
- required	 (for mandatory fiels)
- value_range
	min_value
	max_value (for numeric field)
- choices
	[choices array]	(for predefined choices)

- min_item_count
- max_item_count	(for array data type, to restrict number of items)
- sub_nodes			(for nested objects)

## Example Schema:

```
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
```

###### Sample JSON Payload to Validate
```
$json_raw = '
{
  "title": "This is titlle",
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

```

###### Usage:

```
<?php

	$jsonschemavalidator = new JsonSchemaValidator();
	$jsonschemavalidator->validateSchema($_payLoadSchema, $json_raw);
	
	if($validated){
		echo "JSON Validated";
	} else {
		echo "JSON not validated";
		print_r($jsonschemavalidator->getErrors());
	}
```	


