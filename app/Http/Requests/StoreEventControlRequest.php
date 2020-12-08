<?php

namespace App\Http\Requests;

use App\Models\EventControl;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventControlRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_control_create');
    }

    public function rules()
    {
        return [
            'title'        => [
                'string',
                'required',
            ],
            'date'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time'         => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'payment'      => [
                'string',
                'nullable',
            ],
            'participants' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status'       => [
                'string',
                'required',
            ],
            'category_id'  => [
                'required',
                'integer',
            ],
        ];
    }
}
