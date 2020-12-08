<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAddFeedbackRequest;
use App\Http\Requests\StoreAddFeedbackRequest;
use App\Http\Requests\UpdateAddFeedbackRequest;
use App\Models\AddFeedback;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AddFeedbackController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('add_feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFeedbacks = AddFeedback::with(['username'])->get();

        return view('frontend.addFeedbacks.index', compact('addFeedbacks'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_feedback_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addFeedbacks.create', compact('usernames'));
    }

    public function store(StoreAddFeedbackRequest $request)
    {
        $addFeedback = AddFeedback::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $addFeedback->id]);
        }

        return redirect()->route('frontend.add-feedbacks.index');
    }

    public function edit(AddFeedback $addFeedback)
    {
        abort_if(Gate::denies('add_feedback_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addFeedback->load('username');

        return view('frontend.addFeedbacks.edit', compact('usernames', 'addFeedback'));
    }

    public function update(UpdateAddFeedbackRequest $request, AddFeedback $addFeedback)
    {
        $addFeedback->update($request->all());

        return redirect()->route('frontend.add-feedbacks.index');
    }

    public function show(AddFeedback $addFeedback)
    {
        abort_if(Gate::denies('add_feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFeedback->load('username');

        return view('frontend.addFeedbacks.show', compact('addFeedback'));
    }

    public function destroy(AddFeedback $addFeedback)
    {
        abort_if(Gate::denies('add_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFeedback->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddFeedbackRequest $request)
    {
        AddFeedback::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('add_feedback_create') && Gate::denies('add_feedback_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AddFeedback();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
