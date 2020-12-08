<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddUnitRequest;
use App\Http\Requests\UpdateAddUnitRequest;
use App\Http\Resources\Admin\AddUnitResource;
use App\Models\AddUnit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddUnitApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddUnitResource(AddUnit::with(['block'])->get());
    }

    public function store(StoreAddUnitRequest $request)
    {
        $addUnit = AddUnit::create($request->all());

        return (new AddUnitResource($addUnit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddUnitResource($addUnit->load(['block']));
    }

    public function update(UpdateAddUnitRequest $request, AddUnit $addUnit)
    {
        $addUnit->update($request->all());

        return (new AddUnitResource($addUnit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
