<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarparkLogRequest;
use App\Http\Requests\StoreCarparkLogRequest;
use App\Http\Requests\UpdateCarparkLogRequest;
use App\Models\CarparkLocation;
use App\Models\CarparkLog;
use App\Models\VehicleManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarparkLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('carpark_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CarparkLog::with(['carplate', 'location'])->select(sprintf('%s.*', (new CarparkLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'carpark_log_show';
                $editGate      = 'carpark_log_edit';
                $deleteGate    = 'carpark_log_delete';
                $crudRoutePart = 'carpark-logs';

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
            $table->editColumn('time_in', function ($row) {
                return $row->time_in ? $row->time_in : "";
            });
            $table->editColumn('time_out', function ($row) {
                return $row->time_out ? $row->time_out : "";
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->addColumn('carplate_car_plate', function ($row) {
                return $row->carplate ? $row->carplate->car_plate : '';
            });

            $table->addColumn('location_location', function ($row) {
                return $row->location ? $row->location->location : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'carplate', 'location']);

            return $table->make(true);
        }

        return view('admin.carparkLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carplates = VehicleManagement::all()->pluck('car_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carparkLogs.create', compact('carplates', 'locations'));
    }

    public function store(StoreCarparkLogRequest $request)
    {
        $carparkLog = CarparkLog::create($request->all());

        return redirect()->route('admin.carpark-logs.index');
    }

    public function edit(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carplates = VehicleManagement::all()->pluck('car_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carparkLog->load('carplate', 'location');

        return view('admin.carparkLogs.edit', compact('carplates', 'locations', 'carparkLog'));
    }

    public function update(UpdateCarparkLogRequest $request, CarparkLog $carparkLog)
    {
        $carparkLog->update($request->all());

        return redirect()->route('admin.carpark-logs.index');
    }

    public function show(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLog->load('carplate', 'location');

        return view('admin.carparkLogs.show', compact('carparkLog'));
    }

    public function destroy(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarparkLogRequest $request)
    {
        CarparkLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
