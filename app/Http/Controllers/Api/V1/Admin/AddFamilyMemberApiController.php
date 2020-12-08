<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddFamilyMemberRequest;
use App\Http\Requests\UpdateAddFamilyMemberRequest;
use App\Http\Resources\Admin\AddFamilyMemberResource;
use App\Models\AddFamilyMember;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddFamilyMemberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_family_member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddFamilyMemberResource(AddFamilyMember::with(['unit', 'family_member'])->get());
    }

    public function store(StoreAddFamilyMemberRequest $request)
    {
        $addFamilyMember = AddFamilyMember::create($request->all());

        return (new AddFamilyMemberResource($addFamilyMember))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddFamilyMemberResource($addFamilyMember->load(['unit', 'family_member']));
    }

    public function update(UpdateAddFamilyMemberRequest $request, AddFamilyMember $addFamilyMember)
    {
        $addFamilyMember->update($request->all());

        return (new AddFamilyMemberResource($addFamilyMember))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFamilyMember->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
