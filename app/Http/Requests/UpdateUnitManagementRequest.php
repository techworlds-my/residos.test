<?php

namespace App\Http\Requests;

use App\Models\UnitManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUnitManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_management_edit');
    }

    public function rules()
    {
        return [
            'unit_id'  => [
                'required',
                'integer',
            ],
            'owner_id' => [
                'required',
                'integer',
            ],
            'status'   => [
                'required',
            ],
            'size'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
