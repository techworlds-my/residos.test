<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventPaymentRequest;
use App\Http\Requests\UpdateEventPaymentRequest;
use App\Http\Resources\Admin\EventPaymentResource;
use App\Models\EventPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventPaymentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventPaymentResource(EventPayment::with(['username', 'event'])->get());
    }

    public function store(StoreEventPaymentRequest $request)
    {
        $eventPayment = EventPayment::create($request->all());

        return (new EventPaymentResource($eventPayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventPayment $eventPayment)
    {
        abort_if(Gate::denies('event_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventPaymentResource($eventPayment->load(['username', 'event']));
    }

    public function update(UpdateEventPaymentRequest $request, EventPayment $eventPayment)
    {
        $eventPayment->update($request->all());

        return (new EventPaymentResource($eventPayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventPayment $eventPayment)
    {
        abort_if(Gate::denies('event_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventPayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
