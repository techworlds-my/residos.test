<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddUnitRequest;
use App\Http\Requests\StoreAddUnitRequest;
use App\Http\Requests\UpdateAddUnitRequest;
use App\Models\AddBlock;
use App\Models\AddUnit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddUnitController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('add_unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddUnit::with(['block'])->select(sprintf('%s.*', (new AddUnit)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_unit_show';
                $editGate      = 'add_unit_edit';
                $deleteGate    = 'add_unit_delete';
                $crudRoutePart = 'add-units';

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
            $table->editColumn('unit', function ($row) {
                return $row->unit ? $row->unit : "";
            });
            $table->editColumn('floor', function ($row) {
                return $row->floor ? $row->floor : "";
            });
            $table->addColumn('block_block', function ($row) {
                return $row->block ? $row->block->block : '';
            });

            $table->editColumn('unit_square', function ($row) {
                return $row->unit_square ? $row->unit_square : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'block']);

            return $table->make(true);
        }

        return view('admin.addUnits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = AddBlock::all()->pluck('block', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addUnits.create', compact('blocks'));
    }

    public function store(StoreAddUnitRequest $request)
    {
        $addUnit = AddUnit::create($request->all());

        return redirect()->route('admin.add-units.index');
    }

    public function edit(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = AddBlock::all()->pluck('block', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addUnit->load('block');

        return view('admin.addUnits.edit', compact('blocks', 'addUnit'));
    }

    public function update(UpdateAddUnitRequest $request, AddUnit $addUnit)
    {
        $addUnit->update($request->all());

        return redirect()->route('admin.add-units.index');
    }

    public function show(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnit->load('block');

        return view('admin.addUnits.show', compact('addUnit'));
    }

    public function destroy(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnit->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddUnitRequest $request)
    {
        AddUnit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
