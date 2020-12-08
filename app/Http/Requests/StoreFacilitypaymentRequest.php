<?php

namespace App\Http\Requests;

use App\Models\Facilitypayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFacilitypaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facilitypayment_create');
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
