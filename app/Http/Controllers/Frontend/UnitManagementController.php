<?php

namespace App\Http\Controllers\Frontend;

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

class UnitManagementController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('unit_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitManagements = UnitManagement::with(['unit', 'owner', 'media'])->get();

        return view('frontend.unitManagements.index', compact('unitManagements'));
    }

    public function create()
    {
        abort_if(Gate::denies('unit_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.unitManagements.create', compact('units', 'owners'));
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

        return redirect()->route('frontend.unit-managements.index');
    }

    public function edit(UnitManagement $unitManagement)
    {
        abort_if(Gate::denies('unit_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unitManagement->load('unit', 'owner');

        return view('frontend.unitManagements.edit', compact('units', 'owners', 'unitManagement'));
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

        return redirect()->route('frontend.unit-managements.index');
    }

    public function show(UnitManagement $unitManagement)
    {
        abort_if(Gate::denies('unit_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitManagement->load('unit', 'owner');

        return view('frontend.unitManagements.show', compact('unitManagement'));
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
