<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVehicleModelRequest;
use App\Http\Requests\StoreVehicleModelRequest;
use App\Http\Requests\UpdateVehicleModelRequest;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleModelController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('vehicle_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModels = VehicleModel::with(['brand'])->get();

        $vehicle_brands = VehicleBrand::get();

        return view('frontend.vehicleModels.index', compact('vehicleModels', 'vehicle_brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.vehicleModels.create', compact('brands'));
    }

    public function store(StoreVehicleModelRequest $request)
    {
        $vehicleModel = VehicleModel::create($request->all());

        return redirect()->route('frontend.vehicle-models.index');
    }

    public function edit(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleModel->load('brand');

        return view('frontend.vehicleModels.edit', compact('brands', 'vehicleModel'));
    }

    public function update(UpdateVehicleModelRequest $request, VehicleModel $vehicleModel)
    {
        $vehicleModel->update($request->all());

        return redirect()->route('frontend.vehicle-models.index');
    }

    public function show(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModel->load('brand');

        return view('frontend.vehicleModels.show', compact('vehicleModel'));
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleModelRequest $request)
    {
        VehicleModel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
