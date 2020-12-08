<?php

namespace App\Http\Requests;

use App\Models\DefactCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDefactCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('defact_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:defact_categories,id',
        ];
    }
}
