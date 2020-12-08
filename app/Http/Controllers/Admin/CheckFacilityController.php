<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCheckFacilityRequest;
use App\Http\Requests\StoreCheckFacilityRequest;
use App\Http\Requests\UpdateCheckFacilityRequest;
use App\Models\CheckFacility;
use App\Models\DefactCategory;
use App\Models\FacilityManagement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CheckFacilityController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('check_facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CheckFacility::with(['user', 'facility', 'defect'])->select(sprintf('%s.*', (new CheckFacility)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'check_facility_show';
                $editGate      = 'check_facility_edit';
                $deleteGate    = 'check_facility_delete';
                $crudRoutePart = 'check-facilities';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? CheckFacility::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
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

            $table->addColumn('facility_name', function ($row) {
                return $row->facility ? $row->facility->name : '';
            });

            $table->addColumn('defect_defact_category', function ($row) {
                return $row->defect ? $row->defect->defact_category : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'image', 'facility', 'defect']);

            return $table->make(true);
        }

        return view('admin.checkFacilities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('check_facility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $defects = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.checkFacilities.create', compact('users', 'facilities', 'defects'));
    }

    public function store(StoreCheckFacilityRequest $request)
    {
        $checkFacility = CheckFacility::create($request->all());

        if ($request->input('image', false)) {
            $checkFacility->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $checkFacility->id]);
        }

        return redirect()->route('admin.check-facilities.index');
    }

    public function edit(CheckFacility $checkFacility)
    {
        abort_if(Gate::denies('check_facility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $defects = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkFacility->load('user', 'facility', 'defect');

        return view('admin.checkFacilities.edit', compact('users', 'facilities', 'defects', 'checkFacility'));
    }

    public function update(UpdateCheckFacilityRequest $request, CheckFacility $checkFacility)
    {
        $checkFacility->update($request->all());

        if ($request->input('image', false)) {
            if (!$checkFacility->image || $request->input('image') !== $checkFacility->image->file_name) {
                if ($checkFacility->image) {
                    $checkFacility->image->delete();
                }

                $checkFacility->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($checkFacility->image) {
            $checkFacility->image->delete();
        }

        return redirect()->route('admin.check-facilities.index');
    }

    public function show(CheckFacility $checkFacility)
    {
        abort_if(Gate::denies('check_facility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkFacility->load('user', 'facility', 'defect');

        return view('admin.checkFacilities.show', compact('checkFacility'));
    }

    public function destroy(CheckFacility $checkFacility)
    {
        abort_if(Gate::denies('check_facility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkFacility->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckFacilityRequest $request)
    {
        CheckFacility::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('check_facility_create') && Gate::denies('check_facility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CheckFacility();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
