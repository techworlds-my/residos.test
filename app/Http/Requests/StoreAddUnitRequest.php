<?php

namespace App\Http\Requests;

use App\Models\AddUnit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_unit_create');
    }

    public function rules()
    {
        return [
            'unit'        => [
                'string',
                'required',
            ],
            'floor'       => [
                'string',
                'required',
            ],
            'block_id'    => [
                'required',
                'integer',
            ],
            'unit_square' => [
                'numeric',
                'required',
            ],
        ];
    }
}
