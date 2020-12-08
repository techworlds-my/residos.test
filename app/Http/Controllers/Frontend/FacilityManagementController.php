<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFacilityManagementRequest;
use App\Http\Requests\StoreFacilityManagementRequest;
use App\Http\Requests\UpdateFacilityManagementRequest;
use App\Models\FacilityCategory;
use App\Models\FacilityManagement;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FacilityManagementController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('facility_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityManagements = FacilityManagement::with(['category', 'media'])->get();

        return view('frontend.facilityManagements.index', compact('facilityManagements'));
    }

    public function create()
    {
        abort_if(Gate::denies('facility_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FacilityCategory::all()->pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.facilityManagements.create', compact('categories'));
    }

    public function store(StoreFacilityManagementRequest $request)
    {
        $facilityManagement = FacilityManagement::create($request->all());

        if ($request->input('image', false)) {
            $facilityManagement->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $facilityManagement->id]);
        }

        return redirect()->route('frontend.facility-managements.index');
    }

    public function edit(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FacilityCategory::all()->pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilityManagement->load('category');

        return view('frontend.facilityManagements.edit', compact('categories', 'facilityManagement'));
    }

    public function update(UpdateFacilityManagementRequest $request, FacilityManagement $facilityManagement)
    {
        $facilityManagement->update($request->all());

        if ($request->input('image', false)) {
            if (!$facilityManagement->image || $request->input('image') !== $facilityManagement->image->file_name) {
                if ($facilityManagement->image) {
                    $facilityManagement->image->delete();
                }

                $facilityManagement->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($facilityManagement->image) {
            $facilityManagement->image->delete();
        }

        return redirect()->route('frontend.facility-managements.index');
    }

    public function show(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityManagement->load('category');

        return view('frontend.facilityManagements.show', compact('facilityManagement'));
    }

    public function destroy(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacilityManagementRequest $request)
    {
        FacilityManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('facility_management_create') && Gate::denies('facility_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FacilityManagement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
