<?php

namespace App\Http\Requests;

use App\Models\FormCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFormCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('form_category_create');
    }

    public function rules()
    {
        return [
            'category' => [
                'string',
                'required',
            ],
        ];
    }
}
