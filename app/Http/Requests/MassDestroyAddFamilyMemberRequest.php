<?php

namespace App\Http\Requests;

use App\Models\AddFamilyMember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddFamilyMemberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_family_member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_family_members,id',
        ];
    }
}
