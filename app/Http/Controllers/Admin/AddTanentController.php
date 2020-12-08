<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddTanentRequest;
use App\Http\Requests\StoreAddTanentRequest;
use App\Http\Requests\UpdateAddTanentRequest;
use App\Models\AddTanent;
use App\Models\AddUnit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddTanentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('add_tanent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddTanent::with(['unit', 'tanent'])->select(sprintf('%s.*', (new AddTanent)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_tanent_show';
                $editGate      = 'add_tanent_edit';
                $deleteGate    = 'add_tanent_delete';
                $crudRoutePart = 'add-tanents';

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

            $table->addColumn('tanent_name', function ($row) {
                return $row->tanent ? $row->tanent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'tanent']);

            return $table->make(true);
        }

        return view('admin.addTanents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_tanent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tanents = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addTanents.create', compact('units', 'tanents'));
    }

    public function store(StoreAddTanentRequest $request)
    {
        $addTanent = AddTanent::create($request->all());

        return redirect()->route('admin.add-tanents.index');
    }

    public function edit(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tanents = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addTanent->load('unit', 'tanent');

        return view('admin.addTanents.edit', compact('units', 'tanents', 'addTanent'));
    }

    public function update(UpdateAddTanentRequest $request, AddTanent $addTanent)
    {
        $addTanent->update($request->all());

        return redirect()->route('admin.add-tanents.index');
    }

    public function show(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanent->load('unit', 'tanent');

        return view('admin.addTanents.show', compact('addTanent'));
    }

    public function destroy(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanent->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddTanentRequest $request)
    {
        AddTanent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
