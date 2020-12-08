<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStatusControlRequest;
use App\Http\Requests\StoreStatusControlRequest;
use App\Http\Requests\UpdateStatusControlRequest;
use App\Models\StatusControl;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StatusControlController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('status_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StatusControl::query()->select(sprintf('%s.*', (new StatusControl)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'status_control_show';
                $editGate      = 'status_control_edit';
                $deleteGate    = 'status_control_delete';
                $crudRoutePart = 'status-controls';

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
                return $row->status ? $row->status : "";
            });
            $table->editColumn('desctiption', function ($row) {
                return $row->desctiption ? $row->desctiption : "";
            });
            $table->editColumn('in_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->in_enable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'in_enable']);

            return $table->make(true);
        }

        return view('admin.statusControls.index');
    }

    public function create()
    {
        abort_if(Gate::denies('status_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusControls.create');
    }

    public function store(StoreStatusControlRequest $request)
    {
        $statusControl = StatusControl::create($request->all());

        return redirect()->route('admin.status-controls.index');
    }

    public function edit(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusControls.edit', compact('statusControl'));
    }

    public function update(UpdateStatusControlRequest $request, StatusControl $statusControl)
    {
        $statusControl->update($request->all());

        return redirect()->route('admin.status-controls.index');
    }

    public function show(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusControls.show', compact('statusControl'));
    }

    public function destroy(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusControl->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatusControlRequest $request)
    {
        StatusControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
