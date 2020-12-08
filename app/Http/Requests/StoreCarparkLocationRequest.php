<?php

namespace App\Http\Requests;

use App\Models\CarparkLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarparkLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpark_location_create');
    }

    public function rules()
    {
        return [
            'location'  => [
                'string',
                'required',
            ],
            'is_enable' => [
                'required',
            ],
        ];
    }
}
