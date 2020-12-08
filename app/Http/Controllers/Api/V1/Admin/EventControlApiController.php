<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventControlRequest;
use App\Http\Requests\UpdateEventControlRequest;
use App\Http\Resources\Admin\EventControlResource;
use App\Models\EventControl;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventControlApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventControlResource(EventControl::with(['category', 'audience_group'])->get());
    }

    public function store(StoreEventControlRequest $request)
    {
        $eventControl = EventControl::create($request->all());

        if ($request->input('image', false)) {
            $eventControl->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new EventControlResource($eventControl))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventControl $eventControl)
    {
        abort_if(Gate::denies('event_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventControlResource($eventControl->load(['category', 'audience_group']));
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

        return (new EventControlResource($eventControl))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventControl $eventControl)
    {
        abort_if(Gate::denies('event_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventControl->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
