<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarparkPaymentRequest;
use App\Http\Requests\StoreCarparkPaymentRequest;
use App\Http\Requests\UpdateCarparkPaymentRequest;
use App\Models\CarparkLocation;
use App\Models\CarparkPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarparkPaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpark_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayments = CarparkPayment::with(['location'])->get();

        return view('frontend.carparkPayments.index', compact('carparkPayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.carparkPayments.create', compact('locations'));
    }

    public function store(StoreCarparkPaymentRequest $request)
    {
        $carparkPayment = CarparkPayment::create($request->all());

        return redirect()->route('frontend.carpark-payments.index');
    }

    public function edit(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carparkPayment->load('location');

        return view('frontend.carparkPayments.edit', compact('locations', 'carparkPayment'));
    }

    public function update(UpdateCarparkPaymentRequest $request, CarparkPayment $carparkPayment)
    {
        $carparkPayment->update($request->all());

        return redirect()->route('frontend.carpark-payments.index');
    }

    public function show(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayment->load('location');

        return view('frontend.carparkPayments.show', compact('carparkPayment'));
    }

    public function destroy(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarparkPaymentRequest $request)
    {
        CarparkPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
