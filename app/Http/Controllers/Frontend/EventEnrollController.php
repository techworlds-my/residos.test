<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventEnrollRequest;
use App\Http\Requests\StoreEventEnrollRequest;
use App\Http\Requests\UpdateEventEnrollRequest;
use App\Models\EventControl;
use App\Models\EventEnroll;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventEnrollController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_enroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventEnrolls = EventEnroll::with(['event', 'username'])->get();

        return view('frontend.eventEnrolls.index', compact('eventEnrolls'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_enroll_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventEnrolls.create', compact('events', 'usernames'));
    }

    public function store(StoreEventEnrollRequest $request)
    {
        $eventEnroll = EventEnroll::create($request->all());

        return redirect()->route('frontend.event-enrolls.index');
    }

    public function edit(EventEnroll $eventEnroll)
    {
        abort_if(Gate::denies('event_enroll_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventEnroll->load('event', 'username');

        return view('frontend.eventEnrolls.edit', compact('events', 'usernames', 'eventEnroll'));
    }

    public function update(UpdateEventEnrollRequest $request, EventEnroll $eventEnroll)
    {
        $eventEnroll->update($request->all());

        return redirect()->route('frontend.event-enrolls.index');
    }

    public function show(EventEnroll $eventEnroll)
    {
        abort_if(Gate::denies('event_enroll_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventEnroll->load('event', 'username');

        return view('frontend.eventEnrolls.show', compact('eventEnroll'));
    }

    public function destroy(EventEnroll $eventEnroll)
    {
        abort_if(Gate::denies('event_enroll_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventEnroll->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventEnrollRequest $request)
    {
        EventEnroll::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
