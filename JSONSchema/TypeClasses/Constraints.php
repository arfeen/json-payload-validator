<?php

/**
 * Constraints class responsible for value constraints
 * 
 * @package JsonSchemaValidator
 * @author Muhammad Arfeen
 * @version 1.0
 * 
 */

namespace JSONSchema\TypeClasses;

use JSONSchema\SchemaException;
use JSONSchema\JsonSchemaValidator;

class Constraints {

    /**
     * Check if value even exists
     * 
     * @return boolean
     */
    public function isBlank() {

        if (!isset($this->node_object->required)) {
            return false;
        }

        if ($this->node_object->required) {
            if (empty($this->inputjson)) {
                $this->error_nodes[] = sprintf("Value required for '%s'", $this->node_object->name);
                return true;
            }
        } else {
            if (empty($this->inputjson)) {
                return false;
            }
        }

        return false;
    }

    /**
     * validate maximum length of string
     * 
     * @return boolean
     */
    public function validateLength() {

        if (!isset($this->node_object->max_length) || !$this->node_object->max_length)
            return true;

        if (strlen($this->inputjson) > $this->node_object->max_length) {
            $this->error_nodes[] = sprintf("Invalid text length for '%s'", $this->node_object->name);
            return false;
        }

        return true;
    }

    /**
     * Check number range
     * 
     * @return boolean
     */
    public function numRangeCheck() {

        if (isset($this->node_object->value_range)) {
            $this->node_object->value_range = (object) $this->node_object->value_range;

            if (!isset($this->node_object->value_range->min_value) || !isset($this->node_object->value_range->max_value)) {
                throw new SchemaException("Invalid schema definition in method: " . __FUNCTION__ . " / Class: " . __CLASS__, 1001);
                return false;
            }

            if ($this->inputjson < $this->node_object->value_range->min_value || $this->inputjson > $this->node_object->value_range->max_value) {
                $this->error_nodes[] = sprintf("Items should be in between %d and %d for '%s' ", $this->node_object->value_range->min_value, $this->node_object->value_range->max_value, $this->node_object->name);
                return false;
            }
        }

        return true;
    }

    /**
     * Check number of items in the array
     * 
     * @return boolean
     */
    public function itemsCountCheck() {


        if (!isset($this->node_object->min_item_count) && !isset($this->node_object->max_item_count)) {
            return true;
        }

        if (isset($this->node_object->min_item_count) && !isset($this->node_object->max_item_count)) {
            if (count($this->inputjson) < $this->node_object->min_item_count) {
                $this->error_nodes[] = sprintf("Total number of items should be at least %d for '%s' ", $this->node_object->min_item_count, $this->node_object->name);
                return false;
            } else {
                return true;
            }
        }

        if (!isset($this->node_object->min_item_count) && isset($this->node_object->max_item_count)) {
            if (count($this->inputjson) > $this->node_object->max_item_count) {
                $this->error_nodes[] = sprintf("Total number of items should not exceed %d for '%s' ", $this->node_object->max_item_count, $this->node_object->name);
                return false;
            } else {
                return true;
            }
        }

        if (count($this->inputjson) < $this->node_object->min_item_count || count($this->inputjson) > $this->node_object->max_item_count) {
            $this->error_nodes[] = sprintf("Total number of items should be in between %d and %d for '%s' ", $this->node_object->min_item_count, $this->node_object->max_item_count, $this->node_object->name);
            return false;
        }

        return true;
    }

    /**
     * Get errors from the constraints
     * 
     * @return array
     */
    public function getErrors() {
        $errors = $this->error_nodes;
        return $errors;
    }

}
