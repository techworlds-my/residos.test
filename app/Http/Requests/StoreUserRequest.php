<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name'           => [
                'string',
                'required',
            ],
            'email'          => [
                'required',
                'unique:users',
            ],
            'username'       => [
                'string',
                'required',
                'unique:users',
            ],
            'password'       => [
                'required',
            ],
            'roles.*'        => [
                'integer',
            ],
            'roles'          => [
                'required',
                'array',
            ],
            'total_point'    => [
                'numeric',
            ],
            'current_point'  => [
                'numeric',
            ],
            'ic_number'      => [
                'string',
                'nullable',
            ],
            'contact_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
