<?php

namespace App\Http\Requests;

use App\Models\AddFeedback;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_feedbacks,id',
        ];
    }
}
