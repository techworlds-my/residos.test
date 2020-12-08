<?php

namespace App\Http\Requests;

use App\Models\CarparkLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarparkLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carpark_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carpark_logs,id',
        ];
    }
}
