<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusControlRequest;
use App\Http\Requests\UpdateStatusControlRequest;
use App\Http\Resources\Admin\StatusControlResource;
use App\Models\StatusControl;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusControlApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('status_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusControlResource(StatusControl::all());
    }

    public function store(StoreStatusControlRequest $request)
    {
        $statusControl = StatusControl::create($request->all());

        return (new StatusControlResource($statusControl))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusControlResource($statusControl);
    }

    public function update(UpdateStatusControlRequest $request, StatusControl $statusControl)
    {
        $statusControl->update($request->all());

        return (new StatusControlResource($statusControl))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusControl->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
