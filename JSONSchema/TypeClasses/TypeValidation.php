<?php

/**
 * Class for calling data type validator
 * 
 * @package JsonSchemaValidator
 * @author Muhammad Arfeen
 * @version 1.0
 * 
 * 
 */

namespace JSONSchema\TypeClasses;

use JSONSchema\JsonSchemaValidator;
use JSONSchema\TypeClasses;
use JSONSchema\TypeClasses\Constraints;

class TypeValidation {

    /**
     * Data Type Interface
     * @var object
     */
    private $validator;

    public function __construct(TypeCheck $validator) {
        $this->validator = $validator;
    }

    /**
     * Method to call data type validator classes
     * 
     * @return boolean
     */
    public function callValidator($datatype) {

        if ($datatype != "boolean")
            if ($this->validator->isBlank()) {
                return false;
            }

        return $this->validator->validateType();
    }

}
