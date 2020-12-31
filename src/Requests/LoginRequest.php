<?php

namespace Junyan\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = request("type", null);
        return [
            "type"    => ["required", Rule::in(["code", "password"])],
            "account" => ["required", Rule::exists("users", "phone")->where("status", true)],
            "password" => [$type == "password" ? "required" : "nullable", "max:32"],
            "code" => [$type == "code" ? "required" : "nullable", "max:6"],
        ];
    }
}
