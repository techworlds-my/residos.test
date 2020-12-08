<?php

namespace App\Http\Requests;

use App\Models\AddFamilyMember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddFamilyMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_family_member_create');
    }

    public function rules()
    {
        return [
            'unit_id'          => [
                'required',
                'integer',
            ],
            'family_member_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
