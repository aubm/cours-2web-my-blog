<?php

namespace MyBlog\Validation;

class ValidationErrors
{
    private $_errors = [];
    private $_counter = 0;

    public function registerErrorForField($field_name, $error_message)
    {
        if (!isset($this->_errors[$field_name])) {
            $this->_errors[$field_name] = [];
        }

        $this->_errors[$field_name][] = $error_message;
        $this->_counter++;
    }

    /**
     * @return array
     */
    public function getErrorsForField($field_name)
    {
        if (isset($this->_errors[$field_name])) {
            return $this->_errors[$field_name];
        } else {
            return [];
        }
    }

    public function getErrorsCount()
    {
        return $this->_counter;
    }
}