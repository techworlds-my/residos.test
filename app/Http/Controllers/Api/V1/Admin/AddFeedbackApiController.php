<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAddFeedbackRequest;
use App\Http\Requests\UpdateAddFeedbackRequest;
use App\Http\Resources\Admin\AddFeedbackResource;
use App\Models\AddFeedback;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddFeedbackApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('add_feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddFeedbackResource(AddFeedback::with(['username'])->get());
    }

    public function store(StoreAddFeedbackRequest $request)
    {
        $addFeedback = AddFeedback::create($request->all());

        return (new AddFeedbackResource($addFeedback))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddFeedback $addFeedback)
    {
        abort_if(Gate::denies('add_feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddFeedbackResource($addFeedback->load(['username']));
    }

    public function update(UpdateAddFeedbackRequest $request, AddFeedback $addFeedback)
    {
        $addFeedback->update($request->all());

        return (new AddFeedbackResource($addFeedback))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddFeedback $addFeedback)
    {
        abort_if(Gate::denies('add_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFeedback->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
