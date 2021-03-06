<?php

namespace GetCandy\Api\Http\Validators;

class HashidValidator
{
    /**
     * Determines whether a given hashid correctly decodes for the given model
     * @param  String $attribute
     * @param  String $value
     * @param  Array $parameters
     * @param  Validator $validator
     * @return Bool
     */
    public function validForModel($attribute, $value, $parameters, $validator)
    {
        if (empty($parameters)) {
            abort(500, 'hashid_is_valid expects model reference');
        }

        $method = camel_case($parameters[0]);

        $result = app('api')->{$method}()->existsByHashedId($value);

        if (is_array($value)) {
            return $result === count($value);
        }
        return $result;
    }
}
