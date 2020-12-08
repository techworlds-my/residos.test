<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUnitManagementRequest;
use App\Http\Requests\StoreUnitManagementRequest;
use App\Http\Requests\UpdateUnitManagementRequest;
use App\Models\AddUnit;
use App\Models\UnitManagement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnitManagementController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('unit_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UnitManagement::with(['unit', 'owner'])->select(sprintf('%s.*', (new UnitManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'unit_management_show';
                $editGate      = 'unit_management_edit';
                $deleteGate    = 'unit_management_delete';
                $crudRoutePart = 'unit-managements';

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
            $table->addColumn('unit_unit', function ($row) {
                return $row->unit ? $row->unit->unit : '';
            });

            $table->editColumn('unit.floor', function ($row) {
                return $row->unit ? (is_string($row->unit) ? $row->unit : $row->unit->floor) : '';
            });
            $table->addColumn('owner_name', function ($row) {
                return $row->owner ? $row->owner->name : '';
            });

            $table->editColumn('owner.email', function ($row) {
                return $row->owner ? (is_string($row->owner) ? $row->owner : $row->owner->email) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? UnitManagement::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('size', function ($row) {
                return $row->size ? $row->size : "";
            });
            $table->editColumn('spa', function ($row) {
                return $row->spa ? '<a href="' . $row->spa->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'owner', 'spa']);

            return $table->make(true);
        }

        return view('admin.unitManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('unit_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.unitManagements.create', compact('units', 'owners'));
    }

    public function store(StoreUnitManagementRequest $request)
    {
        $unitManagement = UnitManagement::create($request->all());

        if ($request->input('spa', false)) {
            $unitManagement->addMedia(storage_path('tmp/uploads/' . $request->input('spa')))->toMediaCollection('spa');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $unitManagement->id]);
        }

        return redirect()->route('admin.unit-managements.index');
    }

    public function edit(UnitManagement $unitManagement)
    {
        abort_if(Gate::denies('unit_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unitManagement->load('unit', 'owner');

        return view('admin.unitManagements.edit', compact('units', 'owners', 'unitManagement'));
    }

    public function update(UpdateUnitManagementRequest $request, UnitManagement $unitManagement)
    {
        $unitManagement->update($request->all());

        if ($request->input('spa', false)) {
            if (!$unitManagement->spa || $request->input('spa') !== $unitManagement->spa->file_name) {
                if ($unitManagement->spa) {
                    $unitManagement->spa->delete();
                }

                $unitManagement->addMedia(storage_path('tmp/uploads/' . $request->input('spa')))->toMediaCollection('spa');
            }
        } elseif ($unitManagement->spa) {
            $unitManagement->spa->delete();
        }

        return redirect()->route('admin.unit-managements.index');
    }

    public function show(UnitManagement $unitManagement)
    {
        abort_if(Gate::denies('unit_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitManagement->load('unit', 'owner');

        return view('admin.unitManagements.show', compact('unitManagement'));
    }

    public function destroy(UnitManagement $unitManagement)
    {
        abort_if(Gate::denies('unit_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitManagementRequest $request)
    {
        UnitManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('unit_management_create') && Gate::denies('unit_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UnitManagement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
