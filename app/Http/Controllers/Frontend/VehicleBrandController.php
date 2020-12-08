<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVehicleBrandRequest;
use App\Http\Requests\StoreVehicleBrandRequest;
use App\Http\Requests\UpdateVehicleBrandRequest;
use App\Models\VehicleBrand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleBrandController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('vehicle_brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleBrands = VehicleBrand::all();

        return view('frontend.vehicleBrands.index', compact('vehicleBrands'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vehicleBrands.create');
    }

    public function store(StoreVehicleBrandRequest $request)
    {
        $vehicleBrand = VehicleBrand::create($request->all());

        return redirect()->route('frontend.vehicle-brands.index');
    }

    public function edit(VehicleBrand $vehicleBrand)
    {
        abort_if(Gate::denies('vehicle_brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vehicleBrands.edit', compact('vehicleBrand'));
    }

    public function update(UpdateVehicleBrandRequest $request, VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->update($request->all());

        return redirect()->route('frontend.vehicle-brands.index');
    }

    public function show(VehicleBrand $vehicleBrand)
    {
        abort_if(Gate::denies('vehicle_brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vehicleBrands.show', compact('vehicleBrand'));
    }

    public function destroy(VehicleBrand $vehicleBrand)
    {
        abort_if(Gate::denies('vehicle_brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleBrand->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleBrandRequest $request)
    {
        VehicleBrand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
