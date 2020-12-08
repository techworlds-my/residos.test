<?php

namespace App\Http\Requests;

use App\Models\CarparkLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarparkLocationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carpark_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carpark_locations,id',
        ];
    }
}
