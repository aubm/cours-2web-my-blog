<?php

namespace MyBlog\Validation;

class ValidationException extends \Exception
{
    private $validation_errors;

    public function setValidationErrors(ValidationErrors $validation_errors)
    {
        $this->validation_errors = $validation_errors;
    }

    /**
     * @return ValidationErrors
     */
    public function getValidationErrors()
    {
        return $this->validation_errors;
    }
}