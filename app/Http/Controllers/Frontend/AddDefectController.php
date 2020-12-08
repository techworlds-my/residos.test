<?php

namespace App\Http\Controllers\Frontend;

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

class AddDefectController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('add_defect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addDefects = AddDefect::with(['username', 'category', 'status', 'inchargeperson', 'media'])->get();

        return view('frontend.addDefects.index', compact('addDefects'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_defect_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = StatusControl::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inchargepeople = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addDefects.create', compact('usernames', 'categories', 'statuses', 'inchargepeople'));
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

        return redirect()->route('frontend.add-defects.index');
    }

    public function edit(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = DefactCategory::all()->pluck('defact_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = StatusControl::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inchargepeople = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addDefect->load('username', 'category', 'status', 'inchargeperson');

        return view('frontend.addDefects.edit', compact('usernames', 'categories', 'statuses', 'inchargepeople', 'addDefect'));
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

        return redirect()->route('frontend.add-defects.index');
    }

    public function show(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addDefect->load('username', 'category', 'status', 'inchargeperson');

        return view('frontend.addDefects.show', compact('addDefect'));
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
