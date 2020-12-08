<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCarparkLocationRequest;
use App\Http\Requests\StoreCarparkLocationRequest;
use App\Http\Requests\UpdateCarparkLocationRequest;
use App\Models\CarparkLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarparkLocationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('carpark_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CarparkLocation::query()->select(sprintf('%s.*', (new CarparkLocation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'carpark_location_show';
                $editGate      = 'carpark_location_edit';
                $deleteGate    = 'carpark_location_delete';
                $crudRoutePart = 'carpark-locations';

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
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : "";
            });
            $table->editColumn('is_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_enable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_enable']);

            return $table->make(true);
        }

        return view('admin.carparkLocations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.carparkLocations.create');
    }

    public function store(StoreCarparkLocationRequest $request)
    {
        $carparkLocation = CarparkLocation::create($request->all());

        return redirect()->route('admin.carpark-locations.index');
    }

    public function edit(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.carparkLocations.edit', compact('carparkLocation'));
    }

    public function update(UpdateCarparkLocationRequest $request, CarparkLocation $carparkLocation)
    {
        $carparkLocation->update($request->all());

        return redirect()->route('admin.carpark-locations.index');
    }

    public function show(CarparkLocation $carparkLocation)
    {
        abort_if(Gate::denies('carpark_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.carparkLocations.show', compact('carparkLocation'));
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
