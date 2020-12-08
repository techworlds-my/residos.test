<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFacilitypaymentRequest;
use App\Http\Requests\UpdateFacilitypaymentRequest;
use App\Http\Resources\Admin\FacilitypaymentResource;
use App\Models\Facilitypayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilitypaymentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('facilitypayment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilitypaymentResource(Facilitypayment::with(['username', 'payment_method'])->get());
    }

    public function store(StoreFacilitypaymentRequest $request)
    {
        $facilitypayment = Facilitypayment::create($request->all());

        if ($request->input('reciept', false)) {
            $facilitypayment->addMedia(storage_path('tmp/uploads/' . $request->input('reciept')))->toMediaCollection('reciept');
        }

        return (new FacilitypaymentResource($facilitypayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Facilitypayment $facilitypayment)
    {
        abort_if(Gate::denies('facilitypayment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilitypaymentResource($facilitypayment->load(['username', 'payment_method']));
    }

    public function update(UpdateFacilitypaymentRequest $request, Facilitypayment $facilitypayment)
    {
        $facilitypayment->update($request->all());

        if ($request->input('reciept', false)) {
            if (!$facilitypayment->reciept || $request->input('reciept') !== $facilitypayment->reciept->file_name) {
                if ($facilitypayment->reciept) {
                    $facilitypayment->reciept->delete();
                }

                $facilitypayment->addMedia(storage_path('tmp/uploads/' . $request->input('reciept')))->toMediaCollection('reciept');
            }
        } elseif ($facilitypayment->reciept) {
            $facilitypayment->reciept->delete();
        }

        return (new FacilitypaymentResource($facilitypayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Facilitypayment $facilitypayment)
    {
        abort_if(Gate::denies('facilitypayment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilitypayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
