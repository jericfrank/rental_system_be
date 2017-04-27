<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|unique:users|max:255',
            'password' => 'required',
            'name'     => 'required',
        ];
    }

    public function response(array $errors)
    {
        return response()->json([ 'error' => $errors ], 400 );
    }
}
