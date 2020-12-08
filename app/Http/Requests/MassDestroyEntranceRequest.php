<?php

namespace App\Http\Requests;

use App\Models\Entrance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEntranceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('entrance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:entrances,id',
        ];
    }
}
