<?php

namespace App\Http\Requests;

use App\Models\UnitManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUnitManagementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('unit_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:unit_managements,id',
        ];
    }
}
