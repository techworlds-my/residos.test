<?php

namespace App\Http\Requests;

use App\Models\FormCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFormCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('form_category_edit');
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
