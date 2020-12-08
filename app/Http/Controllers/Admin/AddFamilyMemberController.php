<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class AddFamilyMemberController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('add_family_member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddFamilyMember::with(['unit', 'family_member'])->select(sprintf('%s.*', (new AddFamilyMember)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_family_member_show';
                $editGate      = 'add_family_member_edit';
                $deleteGate    = 'add_family_member_delete';
                $crudRoutePart = 'add-family-members';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('unit_unit', function ($row) {
                return $row->unit ? $row->unit->unit : '';
            });

            $table->addColumn('family_member_name', function ($row) {
                return $row->family_member ? $row->family_member->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'family_member']);

            return $table->make(true);
        }

        return view('admin.addFamilyMembers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_family_member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $family_members = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addFamilyMembers.create', compact('units', 'family_members'));
    }

    public function store(StoreAddFamilyMemberRequest $request)
    {
        $addFamilyMember = AddFamilyMember::create($request->all());

        return redirect()->route('admin.add-family-members.index');
    }

    public function edit(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $family_members = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addFamilyMember->load('unit', 'family_member');

        return view('admin.addFamilyMembers.edit', compact('units', 'family_members', 'addFamilyMember'));
    }

    public function update(UpdateAddFamilyMemberRequest $request, AddFamilyMember $addFamilyMember)
    {
        $addFamilyMember->update($request->all());

        return redirect()->route('admin.add-family-members.index');
    }

    public function show(AddFamilyMember $addFamilyMember)
    {
        abort_if(Gate::denies('add_family_member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addFamilyMember->load('unit', 'family_member');

        return view('admin.addFamilyMembers.show', compact('addFamilyMember'));
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
