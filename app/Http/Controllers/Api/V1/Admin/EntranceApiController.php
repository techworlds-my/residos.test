<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntranceRequest;
use App\Http\Requests\UpdateEntranceRequest;
use App\Http\Resources\Admin\EntranceResource;
use App\Models\Entrance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntranceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entrance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntranceResource(Entrance::with(['location'])->get());
    }

    public function store(StoreEntranceRequest $request)
    {
        $entrance = Entrance::create($request->all());

        return (new EntranceResource($entrance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntranceResource($entrance->load(['location']));
    }

    public function update(UpdateEntranceRequest $request, Entrance $entrance)
    {
        $entrance->update($request->all());

        return (new EntranceResource($entrance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
