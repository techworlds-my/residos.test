<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAddDefectRequest;
use App\Http\Requests\UpdateAddDefectRequest;
use App\Http\Resources\Admin\AddDefectResource;
use App\Models\AddDefect;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddDefectApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('add_defect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddDefectResource(AddDefect::with(['username', 'category', 'status', 'inchargeperson'])->get());
    }

    public function store(StoreAddDefectRequest $request)
    {
        $addDefect = AddDefect::create($request->all());

        if ($request->input('image', false)) {
            $addDefect->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new AddDefectResource($addDefect))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddDefectResource($addDefect->load(['username', 'category', 'status', 'inchargeperson']));
    }

    public function update(UpdateAddDefectRequest $request, AddDefect $addDefect)
    {
        $addDefect->update($request->all());

        if ($request->input('image', false)) {
            if (!$addDefect->image || $request->input('image') !== $addDefect->image->file_name) {
                if ($addDefect->image) {
                    $addDefect->image->delete();
                }

                $addDefect->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($addDefect->image) {
            $addDefect->image->delete();
        }

        return (new AddDefectResource($addDefect))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddDefect $addDefect)
    {
        abort_if(Gate::denies('add_defect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addDefect->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
