<?php

namespace App\Http\Requests;

use App\Models\VehicleModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVehicleModelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_model_edit');
    }

    public function rules()
    {
        return [
            'modal'     => [
                'string',
                'required',
            ],
            'is_enable' => [
                'required',
            ],
            'model'     => [
                'string',
                'required',
            ],
            'is_enable' => [
                'required',
            ],
        ];
    }
}
