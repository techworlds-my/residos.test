<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddFamilyMemberRequest;
use App\Http\Requests\StoreAddFamilyMemberRequest;
use App\Http\Requests\UpdateAddFamilyMemberRequest;
use App\Models\AddFamilyMember;
use App\Models\AddUnit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddFamilyMemberController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_family_member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFamilyMembers = AddFamilyMember::with(['unit', 'family_member'])->get();

        return view('frontend.addFamilyMembers.index', compact('addFamilyMembers'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_family_member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $family_members = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addFamilyMembers.create', compact('units', 'family_members'));
    }

    public function store(StoreAddFamilyMemberRequest $request)
    {
        $addFamilyMember = AddFamilyMember::create($request->all());

        return redirect()->route('frontend.add-family-members.index');
    }

    public function edit(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $family_members = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addFamilyMember->load('unit', 'family_member');

        return view('frontend.addFamilyMembers.edit', compact('units', 'family_members', 'addFamilyMember'));
    }

    public function update(UpdateAddFamilyMemberRequest $request, AddFamilyMember $addFamilyMember)
    {
        $addFamilyMember->update($request->all());

        return redirect()->route('frontend.add-family-members.index');
    }

    public function show(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFamilyMember->load('unit', 'family_member');

        return view('frontend.addFamilyMembers.show', compact('addFamilyMember'));
    }

    public function destroy(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFamilyMember->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddFamilyMemberRequest $request)
    {
        AddFamilyMember::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
