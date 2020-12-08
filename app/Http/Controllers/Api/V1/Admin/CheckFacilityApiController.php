<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCheckFacilityRequest;
use App\Http\Requests\UpdateCheckFacilityRequest;
use App\Http\Resources\Admin\CheckFacilityResource;
use App\Models\CheckFacility;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFacilityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('check_facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckFacilityResource(CheckFacility::with(['user', 'facility', 'defect'])->get());
    }

    public function store(StoreCheckFacilityRequest $request)
    {
        $checkFacility = CheckFacility::create($request->all());

        if ($request->input('image', false)) {
            $checkFacility->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new CheckFacilityResource($checkFacility))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CheckFacility $checkFacility)
    {
        abort_if(Gate::denies('check_facility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckFacilityResource($checkFacility->load(['user', 'facility', 'defect']));
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

        return (new CheckFacilityResource($checkFacility))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CheckFacility $checkFacility)
    {
        abort_if(Gate::denies('check_facility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkFacility->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
