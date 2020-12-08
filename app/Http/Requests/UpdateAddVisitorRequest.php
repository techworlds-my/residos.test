<?php

namespace App\Http\Requests;

use App\Models\AddVisitor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAddVisitorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_visitor_edit');
    }

    public function rules()
    {
        return [
            'status'      => [
                'required',
            ],
            'username_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
