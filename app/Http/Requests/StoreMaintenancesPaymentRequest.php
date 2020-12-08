<?php

namespace App\Http\Requests;

use App\Models\MaintenancesPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaintenancesPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintenances_payment_create');
    }

    public function rules()
    {
        return [
            'amount'            => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month'             => [
                'string',
                'required',
            ],
            'status'            => [
                'required',
            ],
            'username_id'       => [
                'required',
                'integer',
            ],
            'payment_method_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
