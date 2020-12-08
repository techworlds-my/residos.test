<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVehicleManagementRequest;
use App\Http\Requests\StoreVehicleManagementRequest;
use App\Http\Requests\UpdateVehicleManagementRequest;
use App\Models\User;
use App\Models\VehicleBrand;
use App\Models\VehicleManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleManagementController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('vehicle_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleManagements = VehicleManagement::with(['username', 'brand'])->get();

        $users = User::get();

        $vehicle_brands = VehicleBrand::get();

        return view('frontend.vehicleManagements.index', compact('vehicleManagements', 'users', 'vehicle_brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.vehicleManagements.create', compact('usernames', 'brands'));
    }

    public function store(StoreVehicleManagementRequest $request)
    {
        $vehicleManagement = VehicleManagement::create($request->all());

        return redirect()->route('frontend.vehicle-managements.index');
    }

    public function edit(VehicleManagement $vehicleManagement)
    {
        abort_if(Gate::denies('vehicle_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleManagement->load('username', 'brand');

        return view('frontend.vehicleManagements.edit', compact('usernames', 'brands', 'vehicleManagement'));
    }

    public function update(UpdateVehicleManagementRequest $request, VehicleManagement $vehicleManagement)
    {
        $vehicleManagement->update($request->all());

        return redirect()->route('frontend.vehicle-managements.index');
    }

    public function show(VehicleManagement $vehicleManagement)
    {
        abort_if(Gate::denies('vehicle_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleManagement->load('username', 'brand');

        return view('frontend.vehicleManagements.show', compact('vehicleManagement'));
    }

    public function destroy(VehicleManagement $vehicleManagement)
    {
        abort_if(Gate::denies('vehicle_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleManagementRequest $request)
    {
        VehicleManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
