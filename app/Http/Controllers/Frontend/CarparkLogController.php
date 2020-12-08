<?php

namespace App\Http\Controllers\Frontend;

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

class CarparkLogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpark_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLogs = CarparkLog::with(['carplate', 'location'])->get();

        return view('frontend.carparkLogs.index', compact('carparkLogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carplates = VehicleManagement::all()->pluck('car_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.carparkLogs.create', compact('carplates', 'locations'));
    }

    public function store(StoreCarparkLogRequest $request)
    {
        $carparkLog = CarparkLog::create($request->all());

        return redirect()->route('frontend.carpark-logs.index');
    }

    public function edit(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carplates = VehicleManagement::all()->pluck('car_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carparkLog->load('carplate', 'location');

        return view('frontend.carparkLogs.edit', compact('carplates', 'locations', 'carparkLog'));
    }

    public function update(UpdateCarparkLogRequest $request, CarparkLog $carparkLog)
    {
        $carparkLog->update($request->all());

        return redirect()->route('frontend.carpark-logs.index');
    }

    public function show(CarparkLog $carparkLog)
    {
        abort_if(Gate::denies('carpark_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLog->load('carplate', 'location');

        return view('frontend.carparkLogs.show', compact('carparkLog'));
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
