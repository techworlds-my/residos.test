<?php

namespace App\Http\Requests;

use App\Models\Facilitypayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacilitypaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facilitypayment_edit');
    }

    public function rules()
    {
        return [
            'amount'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status'      => [
                'required',
            ],
            'username_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
