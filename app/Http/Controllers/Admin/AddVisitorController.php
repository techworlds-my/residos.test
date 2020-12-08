<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddVisitorRequest;
use App\Http\Requests\StoreAddVisitorRequest;
use App\Http\Requests\UpdateAddVisitorRequest;
use App\Models\AddVisitor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddVisitorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('add_visitor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddVisitor::with(['username', 'add_by'])->select(sprintf('%s.*', (new AddVisitor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_visitor_show';
                $editGate      = 'add_visitor_edit';
                $deleteGate    = 'add_visitor_delete';
                $crudRoutePart = 'add-visitors';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? AddVisitor::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->addColumn('add_by_username', function ($row) {
                return $row->add_by ? $row->add_by->username : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'username', 'add_by']);

            return $table->make(true);
        }

        return view('admin.addVisitors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_visitor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $add_bies = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addVisitors.create', compact('usernames', 'add_bies'));
    }

    public function store(StoreAddVisitorRequest $request)
    {
        $addVisitor = AddVisitor::create($request->all());

        return redirect()->route('admin.add-visitors.index');
    }

    public function edit(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $add_bies = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addVisitor->load('username', 'add_by');

        return view('admin.addVisitors.edit', compact('usernames', 'add_bies', 'addVisitor'));
    }

    public function update(UpdateAddVisitorRequest $request, AddVisitor $addVisitor)
    {
        $addVisitor->update($request->all());

        return redirect()->route('admin.add-visitors.index');
    }

    public function show(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitor->load('username', 'add_by');

        return view('admin.addVisitors.show', compact('addVisitor'));
    }

    public function destroy(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitor->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddVisitorRequest $request)
    {
        AddVisitor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
