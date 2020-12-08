<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddTanentRequest;
use App\Http\Requests\UpdateAddTanentRequest;
use App\Http\Resources\Admin\AddTanentResource;
use App\Models\AddTanent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTanentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_tanent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddTanentResource(AddTanent::with(['unit', 'tanent'])->get());
    }

    public function store(StoreAddTanentRequest $request)
    {
        $addTanent = AddTanent::create($request->all());

        return (new AddTanentResource($addTanent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddTanentResource($addTanent->load(['unit', 'tanent']));
    }

    public function update(UpdateAddTanentRequest $request, AddTanent $addTanent)
    {
        $addTanent->update($request->all());

        return (new AddTanentResource($addTanent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
