<?php
/**
 * Class for Boolean type schema
 * 
 * @package JsonSchemaValidator
 * @author Muhammad Arfeen
 * @version 1.0
 * 
 * 
 */

namespace JSONSchema\TypeClasses;

use JSONSchema\TypeClasses\Constraints;

class TypeDate extends Constraints implements TypeCheck {

    /**
     * Error collection
     * 
     * @var array
     */
    protected $error_nodes = [];

    /**
     * Defined schema object
     * 
     * @var object
     */
    protected $node_object;

    /**
     * Input JSON object
     * @var object
     */
    protected $inputjson;

    /**
     * Constructor to initialize schema and JSON input
     * 
     * @param object $node_object
     * @param object $inputjson
     */
    public function __construct($node_object, $inputjson) {
        $this->node_object = $node_object;
        $this->inputjson = $inputjson;
    }

    /**
     * Validate data type Date
     * 
     * @return boolean
     */
    public function validateType() {

        if (!strtotime($this->inputjson)) {
            $this->error_nodes[] = sprintf("Invalid data type for %s. Acceptable format: YYYY-MM-DD HH:ii:ss", $this->node_object->name);
            return false;
        }

        return true;
    }

}
