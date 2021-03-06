<?php

namespace App\Http\Requests;

use App\Models\Qr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQrRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qr_create');
    }

    public function rules()
    {
        return [
            'code'        => [
                'string',
                'required',
            ],
            'status'      => [
                'string',
                'required',
            ],
            'username_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
