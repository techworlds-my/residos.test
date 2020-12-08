<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarparkPaymentRequest;
use App\Http\Requests\UpdateCarparkPaymentRequest;
use App\Http\Resources\Admin\CarparkPaymentResource;
use App\Models\CarparkPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarparkPaymentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpark_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkPaymentResource(CarparkPayment::with(['location'])->get());
    }

    public function store(StoreCarparkPaymentRequest $request)
    {
        $carparkPayment = CarparkPayment::create($request->all());

        return (new CarparkPaymentResource($carparkPayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarparkPaymentResource($carparkPayment->load(['location']));
    }

    public function update(UpdateCarparkPaymentRequest $request, CarparkPayment $carparkPayment)
    {
        $carparkPayment->update($request->all());

        return (new CarparkPaymentResource($carparkPayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
