<?php

namespace App\Http\Requests;

use App\Models\FacilityBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacilityBookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_book_edit');
    }

    public function rules()
    {
        return [
            'date'        => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time'        => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'facility_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
