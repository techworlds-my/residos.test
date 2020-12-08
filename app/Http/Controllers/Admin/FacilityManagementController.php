<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FacilityManagementController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('facility_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FacilityManagement::with(['category'])->select(sprintf('%s.*', (new FacilityManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'facility_management_show';
                $editGate      = 'facility_management_edit';
                $deleteGate    = 'facility_management_delete';
                $crudRoutePart = 'facility-managements';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? FacilityManagement::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('category_category', function ($row) {
                return $row->category ? $row->category->category : '';
            });

            $table->editColumn('open', function ($row) {
                return $row->open ? $row->open : "";
            });
            $table->editColumn('closed', function ($row) {
                return $row->closed ? $row->closed : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'category']);

            return $table->make(true);
        }

        return view('admin.facilityManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('facility_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FacilityCategory::all()->pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.facilityManagements.create', compact('categories'));
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

        return redirect()->route('admin.facility-managements.index');
    }

    public function edit(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FacilityCategory::all()->pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilityManagement->load('category');

        return view('admin.facilityManagements.edit', compact('categories', 'facilityManagement'));
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

        return redirect()->route('admin.facility-managements.index');
    }

    public function show(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityManagement->load('category');

        return view('admin.facilityManagements.show', compact('facilityManagement'));
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
