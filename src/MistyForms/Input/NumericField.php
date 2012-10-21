<?php

namespace MistyForms\Input;

use MistyForms\Exception\ConfigurationException;

class NumericField extends TextField
{
    public $minValue;
    public $maxValue;
    public $format;

    protected function initialize()
    {
        parent::initialize();

        // minValue and maxValue enstablish what range is valid
        // however, if the field is not 'required' the range is not applied
        $this->minValue = $this->optionalAttribute('minValue', false);
        $this->maxValue = $this->optionalAttribute('maxValue', false);
        $this->format = self::validateSelectedFormat($this->optionalAttribute('format', 'numeric'));
    }

    public function validate()
    {
        if (!parent::validate()) {
            return false;
        }

        if (strlen($this->value) > 0) {
            if (!$this->validateFormat()) {
                return false;
            }

            if ($this->minValue !== false && $this->value < $this->minValue) {
                $this->errorMessage = sprintf(
                    'Please enter a value of %d or higher',
                    $this->minValue
                );

                return false;
            }

            if ($this->maxValue !== false && $this->value > $this->maxValue) {
                $this->errorMessage = sprintf(
                    'Please enter a value of %d or lower',
                    $this->maxValue
                );

                return false;
            }
        }

        return true;
    }


    private function validateFormat()
    {
        if ($this->format === 'numeric' &&
            !is_numeric($this->value)
        ) {
            $this->errorMessage = "Il valore che hai inserito non e' un numero valido";
            return false;
        }

        if ($this->format === 'integer' &&
            filter_var($this->value, FILTER_VALIDATE_INT) === false
        ) {
            $this->errorMessage = "Devi inserire un numero intero";
            return false;
        }

        if ($this->format === 'float' &&
            filter_var($this->value, FILTER_VALIDATE_FLOAT) === false
        ) {
            $this->errorMessage = "Devi inserire un numero con la virgola";
            return false;
        }

        if ($this->format === 'integerorfloat' &&
            filter_var($this->value, FILTER_VALIDATE_INT) === false &&
            filter_var($this->value, FILTER_VALIDATE_FLOAT) === false
        ) {
            $this->errorMessage = "Devi inserire un numero intero o con la virgola";
            return false;
        }

        return true;
    }

    protected function _getData()
    {
        // casting from string to number
        return strlen($this->value) > 0 ? $this->value + 0 : $this->value;
    }

    private static function validateSelectedFormat($format)
    {
        $validFormats = array('numeric', 'integer', 'float', 'integerorfloat');
        if (in_array($format, $validFormats)) {
            return $format;
        }

        throw new ConfigurationException("Invalid number format '$format'. Supported formats are: " . implode(',', $validFormats));
    }
}