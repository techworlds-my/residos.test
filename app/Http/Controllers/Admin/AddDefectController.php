<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAddDefectRequest;
use App\Http\Requests\StoreAddDefectRequest;
use App\Http\Requests\UpdateAddDefectRequest;
use App\Models\AddDefect;
use App\Models\DefactCategory;
use App\Models\StatusControl;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddDefectController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('add_defect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddDefect::with(['username', 'category', 'status', 'inchargeperson'])->select(sprintf('%s.*', (new AddDefect)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_defect_show';
                $editGate      = 'add_defect_edit';
                $deleteGate    = 'add_defect_delete';
                $crudRoutePart = 'add-defects';

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
            $table->editColumn('defect', function ($row) {
                return $row->defect ? $row->defect : "";
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->editColumn('available_time', function ($row) {
                return $row->available_time ? $row->available_time : "";
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });
            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->addColumn('category_defact_category', function ($row) {
                return $row->category ? $row->category->defact_category : '';
            });

            $table->addColumn('status_status', function ($row) {
                return $row->status ? $row->status->status : '';
            });

            $table->addColumn('inchargeperson_username', function ($row) {
                return $row->inchargeperson ? $row->inchargeperson->username : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'username', 'category', 'status', 'inchargeperson']);

            return $table->make(true);
        }

        return view('admin.addDefects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_defect_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = StatusControl::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inchargepeople = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addDefects.create', compact('usernames', 'categories', 'statuses', 'inchargepeople'));
    }

    public function store(StoreAddDefectRequest $request)
    {
        $addDefect = AddDefect::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $addDefect->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $addDefect->id]);
        }

        return redirect()->route('admin.add-defects.index');
    }

    public function edit(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = StatusControl::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inchargepeople = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addDefect->load('username', 'category', 'status', 'inchargeperson');

        return view('admin.addDefects.edit', compact('usernames', 'categories', 'statuses', 'inchargepeople', 'addDefect'));
    }

    public function update(UpdateAddDefectRequest $request, AddDefect $addDefect)
    {
        $addDefect->update($request->all());

        if (count($addDefect->image) > 0) {
            foreach ($addDefect->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $addDefect->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $addDefect->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.add-defects.index');
    }

    public function show(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addDefect->load('username', 'category', 'status', 'inchargeperson');

        return view('admin.addDefects.show', compact('addDefect'));
    }

    public function destroy(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addDefect->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddDefectRequest $request)
    {
        AddDefect::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('add_defect_create') && Gate::denies('add_defect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AddDefect();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
