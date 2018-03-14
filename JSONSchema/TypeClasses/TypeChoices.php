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

class TypeChoices extends Constraints implements TypeCheck {

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
     * Validate data type
     * 
     * @return boolean
     */
    public function validateType() {

        if (in_array($this->inputjson, $this->node_object->choices)) {
            return true;
        }

        $this->error_nodes[] = sprintf("Invalid value for '%s'. Must be one of the values in {%s}", $this->node_object->name, join(",", $this->node_object->choices));
        return false;
    }

}
