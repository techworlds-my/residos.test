<?php

namespace App\Http\Requests;

use App\Models\AddDefect;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddDefectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_defect_create');
    }

    public function rules()
    {
        return [
            'defect'         => [
                'string',
                'required',
            ],
            'image.*'        => [
                'required',
            ],
            'available_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'available_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'remark'         => [
                'string',
                'nullable',
            ],
            'username_id'    => [
                'required',
                'integer',
            ],
            'category_id'    => [
                'required',
                'integer',
            ],
            'status_id'      => [
                'required',
                'integer',
            ],
        ];
    }
}
