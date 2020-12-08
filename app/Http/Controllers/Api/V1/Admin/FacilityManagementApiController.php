<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFacilityManagementRequest;
use App\Http\Requests\UpdateFacilityManagementRequest;
use App\Http\Resources\Admin\FacilityManagementResource;
use App\Models\FacilityManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityManagementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('facility_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityManagementResource(FacilityManagement::with(['category'])->get());
    }

    public function store(StoreFacilityManagementRequest $request)
    {
        $facilityManagement = FacilityManagement::create($request->all());

        if ($request->input('image', false)) {
            $facilityManagement->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new FacilityManagementResource($facilityManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityManagementResource($facilityManagement->load(['category']));
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

        return (new FacilityManagementResource($facilityManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FacilityManagement $facilityManagement)
    {
        abort_if(Gate::denies('facility_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
