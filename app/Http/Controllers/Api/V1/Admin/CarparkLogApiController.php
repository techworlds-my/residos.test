<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarparkLogRequest;
use App\Http\Requests\UpdateCarparkLogRequest;
use App\Http\Resources\Admin\CarparkLogResource;
use App\Models\CarparkLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarparkLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpark_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkLogResource(CarparkLog::with(['carplate', 'location'])->get());
    }

    public function store(StoreCarparkLogRequest $request)
    {
        $carparkLog = CarparkLog::create($request->all());

        return (new CarparkLogResource($carparkLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkLogResource($carparkLog->load(['carplate', 'location']));
    }

    public function update(UpdateCarparkLogRequest $request, CarparkLog $carparkLog)
    {
        $carparkLog->update($request->all());

        return (new CarparkLogResource($carparkLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
