<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventControlRequest;
use App\Http\Requests\StoreEventControlRequest;
use App\Http\Requests\UpdateEventControlRequest;
use App\Models\EventCategory;
use App\Models\EventControl;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventControlController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventControls = EventControl::with(['category', 'audience_group', 'media'])->get();

        return view('frontend.eventControls.index', compact('eventControls'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = EventCategory::all()->pluck('cateogey', 'id')->prepend(trans('global.pleaseSelect'), '');

        $audience_groups = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventControls.create', compact('categories', 'audience_groups'));
    }

    public function store(StoreEventControlRequest $request)
    {
        $eventControl = EventControl::create($request->all());

        if ($request->input('image', false)) {
            $eventControl->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eventControl->id]);
        }

        return redirect()->route('frontend.event-controls.index');
    }

    public function edit(EventControl $eventControl)
    {
        abort_if(Gate::denies('event_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = EventCategory::all()->pluck('cateogey', 'id')->prepend(trans('global.pleaseSelect'), '');

        $audience_groups = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventControl->load('category', 'audience_group');

        return view('frontend.eventControls.edit', compact('categories', 'audience_groups', 'eventControl'));
    }

    public function update(UpdateEventControlRequest $request, EventControl $eventControl)
    {
        $eventControl->update($request->all());

        if ($request->input('image', false)) {
            if (!$eventControl->image || $request->input('image') !== $eventControl->image->file_name) {
                if ($eventControl->image) {
                    $eventControl->image->delete();
                }

                $eventControl->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($eventControl->image) {
            $eventControl->image->delete();
        }

        return redirect()->route('frontend.event-controls.index');
    }

    public function show(EventControl $eventControl)
    {
        abort_if(Gate::denies('event_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventControl->load('category', 'audience_group');

        return view('frontend.eventControls.show', compact('eventControl'));
    }

    public function destroy(EventControl $eventControl)
    {
        abort_if(Gate::denies('event_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventControl->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventControlRequest $request)
    {
        EventControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_control_create') && Gate::denies('event_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EventControl();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
