<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMaintenancesPaymentRequest;
use App\Http\Requests\UpdateMaintenancesPaymentRequest;
use App\Http\Resources\Admin\MaintenancesPaymentResource;
use App\Models\MaintenancesPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenancesPaymentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenances_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenancesPaymentResource(MaintenancesPayment::with(['username', 'payment_method'])->get());
    }

    public function store(StoreMaintenancesPaymentRequest $request)
    {
        $maintenancesPayment = MaintenancesPayment::create($request->all());

        if ($request->input('receipt', false)) {
            $maintenancesPayment->addMedia(storage_path('tmp/uploads/' . $request->input('receipt')))->toMediaCollection('receipt');
        }

        return (new MaintenancesPaymentResource($maintenancesPayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenancesPaymentResource($maintenancesPayment->load(['username', 'payment_method']));
    }

    public function update(UpdateMaintenancesPaymentRequest $request, MaintenancesPayment $maintenancesPayment)
    {
        $maintenancesPayment->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$maintenancesPayment->receipt || $request->input('receipt') !== $maintenancesPayment->receipt->file_name) {
                if ($maintenancesPayment->receipt) {
                    $maintenancesPayment->receipt->delete();
                }

                $maintenancesPayment->addMedia(storage_path('tmp/uploads/' . $request->input('receipt')))->toMediaCollection('receipt');
            }
        } elseif ($maintenancesPayment->receipt) {
            $maintenancesPayment->receipt->delete();
        }

        return (new MaintenancesPaymentResource($maintenancesPayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenancesPayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
