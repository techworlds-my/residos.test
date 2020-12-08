<?php

namespace App\Http\Requests;

use App\Models\DefactCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDefactCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('defact_category_create');
    }

    public function rules()
    {
        return [
            'defact_category' => [
                'string',
                'required',
            ],
        ];
    }
}
