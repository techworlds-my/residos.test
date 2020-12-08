<?php

namespace App\Http\Requests;

use App\Models\FacilityManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacilityManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_management_edit');
    }

    public function rules()
    {
        return [
            'desctiption' => [
                'required',
            ],
            'status'      => [
                'required',
            ],
            'name'        => [
                'string',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'open'        => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'closed'      => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
