<?php

namespace Junyan\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "type"    => ["required", Rule::in(["code", "password"])],
            "accoutn" => ["required", Rule::exists("users", "account")->where("status", true)]
        ];
    }
}
