<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class VehicleModelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vehicle_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VehicleModel::with(['brand'])->select(sprintf('%s.*', (new VehicleModel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vehicle_model_show';
                $editGate      = 'vehicle_model_edit';
                $deleteGate    = 'vehicle_model_delete';
                $crudRoutePart = 'vehicle-models';

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
            $table->editColumn('modal', function ($row) {
                return $row->modal ? $row->modal : "";
            });
            $table->editColumn('is_enable', function ($row) {
                return $row->is_enable ? VehicleModel::IS_ENABLE_SELECT[$row->is_enable] : '';
            });
            $table->addColumn('brand_brand', function ($row) {
                return $row->brand ? $row->brand->brand : '';
            });

            $table->editColumn('model', function ($row) {
                return $row->model ? $row->model : "";
            });
            $table->editColumn('is_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_enable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand', 'is_enable']);

            return $table->make(true);
        }

        $vehicle_brands = VehicleBrand::get();

        return view('admin.vehicleModels.index', compact('vehicle_brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicleModels.create', compact('brands'));
    }

    public function store(StoreVehicleModelRequest $request)
    {
        $vehicleModel = VehicleModel::create($request->all());

        return redirect()->route('admin.vehicle-models.index');
    }

    public function edit(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleModel->load('brand');

        return view('admin.vehicleModels.edit', compact('brands', 'vehicleModel'));
    }

    public function update(UpdateVehicleModelRequest $request, VehicleModel $vehicleModel)
    {
        $vehicleModel->update($request->all());

        return redirect()->route('admin.vehicle-models.index');
    }

    public function show(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModel->load('brand');

        return view('admin.vehicleModels.show', compact('vehicleModel'));
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
