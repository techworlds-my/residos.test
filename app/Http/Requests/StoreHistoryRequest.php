<?php

namespace App\Http\Requests;

use App\Models\History;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('history_create');
    }

    public function rules()
    {
        return [
            'qr'          => [
                'string',
                'required',
            ],
            'type'        => [
                'string',
                'required',
            ],
            'username_id' => [
                'required',
                'integer',
            ],
            'entrance_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
