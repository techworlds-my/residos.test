<?php

namespace App\Http\Requests;

use App\Models\CarparkPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarparkPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpark_payment_create');
    }

    public function rules()
    {
        return [
            'carplate'       => [
                'string',
                'required',
            ],
            'payment'        => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'payment_method' => [
                'string',
                'nullable',
            ],
            'remark'         => [
                'string',
                'nullable',
            ],
            'status'         => [
                'string',
                'required',
            ],
            'location_id'    => [
                'required',
                'integer',
            ],
        ];
    }
}
