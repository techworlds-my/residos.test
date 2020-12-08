<?php

namespace App\Http\Requests;

use App\Models\Entrance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntranceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entrance_edit');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'last_active' => [
                'string',
                'nullable',
            ],
            'location_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
