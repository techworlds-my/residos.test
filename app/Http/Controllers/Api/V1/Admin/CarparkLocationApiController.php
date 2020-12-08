<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarparkLocationRequest;
use App\Http\Requests\UpdateCarparkLocationRequest;
use App\Http\Resources\Admin\CarparkLocationResource;
use App\Models\CarparkLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarparkLocationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpark_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkLocationResource(CarparkLocation::all());
    }

    public function store(StoreCarparkLocationRequest $request)
    {
        $carparkLocation = CarparkLocation::create($request->all());

        return (new CarparkLocationResource($carparkLocation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkLocationResource($carparkLocation);
    }

    public function update(UpdateCarparkLocationRequest $request, CarparkLocation $carparkLocation)
    {
        $carparkLocation->update($request->all());

        return (new CarparkLocationResource($carparkLocation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLocation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
