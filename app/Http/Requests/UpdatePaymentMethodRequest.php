<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_method_edit');
    }

    public function rules()
    {
        return [
            'method'      => [
                'string',
                'required',
            ],
            'status'      => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'in_enable'   => [
                'required',
            ],
        ];
    }
}
