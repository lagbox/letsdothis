<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    protected $updateMethods = ['PUT', 'PATCH'];

    protected function appendUnique($key, $keyName = 'id')
    {
        if (in_array($this->method(), $this->updateMethods) && $param = $this->route($key)) {
            if ($param instanceof Model) {
                $rt = "{$param->getKey()},{$param->getKeyName()}";
            } else {
                $rt = "{$param},{$keyName}";
            }

            return ','. $rt;
        }
    }

    protected function filledOnCreate()
    {
        // if we are updating
        if (in_array($this->method(), $this->updateMethods)) {
            return 'present';
        } else {
            return 'required';
        }
    }
}
