<?php

namespace App\Http\Requests;

use App\Models\StatusControl;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStatusControlRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('status_control_edit');
    }

    public function rules()
    {
        return [
            'status'      => [
                'string',
                'required',
            ],
            'desctiption' => [
                'string',
                'required',
            ],
            'in_enable'   => [
                'required',
            ],
        ];
    }
}
