<?php

namespace App\Http\Requests;

use App\Models\EventControl;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEventControlRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('event_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:event_controls,id',
        ];
    }
}
