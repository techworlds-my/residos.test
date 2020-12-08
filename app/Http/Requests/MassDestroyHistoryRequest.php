<?php

namespace App\Http\Requests;

use App\Models\History;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:histories,id',
        ];
    }
}
