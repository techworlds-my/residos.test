<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVehicleManagementRequest;
use App\Http\Requests\StoreVehicleManagementRequest;
use App\Http\Requests\UpdateVehicleManagementRequest;
use App\Models\User;
use App\Models\VehicleBrand;
use App\Models\VehicleManagement;
use App\Models\VehicleModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VehicleManagementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vehicle_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VehicleManagement::with(['username', 'brand', 'model'])->select(sprintf('%s.*', (new VehicleManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vehicle_management_show';
                $editGate      = 'vehicle_management_edit';
                $deleteGate    = 'vehicle_management_delete';
                $crudRoutePart = 'vehicle-managements';

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
            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->editColumn('car_plate', function ($row) {
                return $row->car_plate ? $row->car_plate : "";
            });
            $table->editColumn('is_verify', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_verify ? 'checked' : null) . '>';
            });
            $table->addColumn('brand_brand', function ($row) {
                return $row->brand ? $row->brand->brand : '';
            });

            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : "";
            });
            $table->editColumn('is_season_park', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_season_park ? 'checked' : null) . '>';
            });
            $table->editColumn('dirver_count', function ($row) {
                return $row->dirver_count ? $row->dirver_count : "";
            });
            $table->editColumn('is_resident', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_resident ? 'checked' : null) . '>';
            });
            $table->addColumn('model_model', function ($row) {
                return $row->model ? $row->model->model : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'username', 'is_verify', 'brand', 'is_season_park', 'is_resident', 'model']);

            return $table->make(true);
        }

        $users          = User::get();
        $vehicle_brands = VehicleBrand::get();
        $vehicle_models = VehicleModel::get();

        return view('admin.vehicleManagements.index', compact('users', 'vehicle_brands', 'vehicle_models'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $models = VehicleModel::all()->pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicleManagements.create', compact('usernames', 'brands', 'models'));
    }

    public function store(StoreVehicleManagementRequest $request)
    {
        $vehicleManagement = VehicleManagement::create($request->all());

        return redirect()->route('admin.vehicle-managements.index');
    }

    public function edit(VehicleManagement $vehicleManagement)
    {
        abort_if(Gate::denies('vehicle_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = VehicleBrand::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $models = VehicleModel::all()->pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleManagement->load('username', 'brand', 'model');

        return view('admin.vehicleManagements.edit', compact('usernames', 'brands', 'models', 'vehicleManagement'));
    }

    public function update(UpdateVehicleManagementRequest $request, VehicleManagement $vehicleManagement)
    {
        $vehicleManagement->update($request->all());

        return redirect()->route('admin.vehicle-managements.index');
    }

    public function show(VehicleManagement $vehicleManagement)
    {
        abort_if(Gate::denies('vehicle_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleManagement->load('username', 'brand', 'model');

        return view('admin.vehicleManagements.show', compact('vehicleManagement'));
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
