<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventPaymentRequest;
use App\Http\Requests\StoreEventPaymentRequest;
use App\Http\Requests\UpdateEventPaymentRequest;
use App\Models\EventControl;
use App\Models\EventPayment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventPaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventPayments = EventPayment::with(['username', 'event'])->get();

        return view('frontend.eventPayments.index', compact('eventPayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventPayments.create', compact('usernames', 'events'));
    }

    public function store(StoreEventPaymentRequest $request)
    {
        $eventPayment = EventPayment::create($request->all());

        return redirect()->route('frontend.event-payments.index');
    }

    public function edit(EventPayment $eventPayment)
    {
        abort_if(Gate::denies('event_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventPayment->load('username', 'event');

        return view('frontend.eventPayments.edit', compact('usernames', 'events', 'eventPayment'));
    }

    public function update(UpdateEventPaymentRequest $request, EventPayment $eventPayment)
    {
        $eventPayment->update($request->all());

        return redirect()->route('frontend.event-payments.index');
    }

    public function show(EventPayment $eventPayment)
    {
        abort_if(Gate::denies('event_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventPayment->load('username', 'event');

        return view('frontend.eventPayments.show', compact('eventPayment'));
    }

    public function destroy(EventPayment $eventPayment)
    {
        abort_if(Gate::denies('event_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventPaymentRequest $request)
    {
        EventPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
