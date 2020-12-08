<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddVisitorRequest;
use App\Http\Requests\UpdateAddVisitorRequest;
use App\Http\Resources\Admin\AddVisitorResource;
use App\Models\AddVisitor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddVisitorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_visitor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddVisitorResource(AddVisitor::with(['username', 'add_by'])->get());
    }

    public function store(StoreAddVisitorRequest $request)
    {
        $addVisitor = AddVisitor::create($request->all());

        return (new AddVisitorResource($addVisitor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddVisitorResource($addVisitor->load(['username', 'add_by']));
    }

    public function update(UpdateAddVisitorRequest $request, AddVisitor $addVisitor)
    {
        $addVisitor->update($request->all());

        return (new AddVisitorResource($addVisitor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
