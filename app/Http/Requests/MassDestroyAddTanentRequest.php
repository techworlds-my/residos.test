<?php

namespace App\Http\Requests;

use App\Models\AddTanent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddTanentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_tanent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_tanents,id',
        ];
    }
}
