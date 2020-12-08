<?php

namespace App\Http\Requests;

use App\Models\CheckFacility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCheckFacilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('check_facility_create');
    }

    public function rules()
    {
        return [
            'user_id'     => [
                'required',
                'integer',
            ],
            'status'      => [
                'required',
            ],
            'date_time'   => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'facility_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
