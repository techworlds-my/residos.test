<?php

namespace App\Http\Requests;

use App\Models\VehicleModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVehicleModelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_model_create');
    }

    public function rules()
    {
        return [
            'brand_id' => [
                'required',
                'integer',
            ],
            'model'    => [
                'string',
                'required',
            ],
        ];
    }
}
