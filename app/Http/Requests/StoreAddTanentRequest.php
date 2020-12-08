<?php

namespace App\Http\Requests;

use App\Models\AddTanent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddTanentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_tanent_create');
    }

    public function rules()
    {
        return [
            'unit_id'   => [
                'required',
                'integer',
            ],
            'tanent_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
