<?php
/**
 * Exception class
 * 
 * @package JsonSchemaValidator
 * @author Muhammad Arfeen
 * @version 1.0
 * 
 */

namespace JSONSchema;

class SchemaException extends \Exception {

    /**
     * 
     * @param string $message
     * @param int $code
     * @param \JSONSchema\Exception $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Convert class to string
     * 
     * @return string
     */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
