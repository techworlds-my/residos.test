<?php

namespace App\Http\Requests;

use App\Models\NoticeBoard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNoticeBoardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notice_board_create');
    }

    public function rules()
    {
        return [
            'title'   => [
                'string',
                'required',
            ],
            'content' => [
                'required',
            ],
            'post_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'post_to' => [
                'string',
                'required',
            ],
            'pinned'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status'  => [
                'string',
                'nullable',
            ],
            'post_by' => [
                'string',
                'nullable',
            ],
        ];
    }
}
