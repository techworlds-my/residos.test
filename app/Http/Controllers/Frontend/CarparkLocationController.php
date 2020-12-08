<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCarparkLocationRequest;
use App\Http\Requests\StoreCarparkLocationRequest;
use App\Http\Requests\UpdateCarparkLocationRequest;
use App\Models\CarparkLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarparkLocationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('carpark_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLocations = CarparkLocation::all();

        return view('frontend.carparkLocations.index', compact('carparkLocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.carparkLocations.create');
    }

    public function store(StoreCarparkLocationRequest $request)
    {
        $carparkLocation = CarparkLocation::create($request->all());

        return redirect()->route('frontend.carpark-locations.index');
    }

    public function edit(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.carparkLocations.edit', compact('carparkLocation'));
    }

    public function update(UpdateCarparkLocationRequest $request, CarparkLocation $carparkLocation)
    {
        $carparkLocation->update($request->all());

        return redirect()->route('frontend.carpark-locations.index');
    }

    public function show(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.carparkLocations.show', compact('carparkLocation'));
    }

    public function destroy(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarparkLocationRequest $request)
    {
        CarparkLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
