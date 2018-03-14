<?php


/**
 * Interface for data type classes
 * 
 * @package JsonSchemaValidator
 * @author Muhammad Arfeen
 * @version 1.0
 * 
 * 
 */
namespace JSONSchema\TypeClasses;

interface TypeCheck {
    public function validateType();
}
