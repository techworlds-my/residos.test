<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class EventEnrollController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_enroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventEnroll::with(['event', 'username'])->select(sprintf('%s.*', (new EventEnroll)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'event_enroll_show';
                $editGate      = 'event_enroll_edit';
                $deleteGate    = 'event_enroll_delete';
                $crudRoutePart = 'event-enrolls';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? EventEnroll::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event', 'username']);

            return $table->make(true);
        }

        return view('admin.eventEnrolls.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_enroll_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventEnrolls.create', compact('events', 'usernames'));
    }

    public function store(StoreEventEnrollRequest $request)
    {
        $eventEnroll = EventEnroll::create($request->all());

        return redirect()->route('admin.event-enrolls.index');
    }

    public function edit(EventEnroll $eventEnroll)
    {
        abort_if(Gate::denies('event_enroll_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = EventControl::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventEnroll->load('event', 'username');

        return view('admin.eventEnrolls.edit', compact('events', 'usernames', 'eventEnroll'));
    }

    public function update(UpdateEventEnrollRequest $request, EventEnroll $eventEnroll)
    {
        $eventEnroll->update($request->all());

        return redirect()->route('admin.event-enrolls.index');
    }

    public function show(EventEnroll $eventEnroll)
    {
        abort_if(Gate::denies('event_enroll_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventEnroll->load('event', 'username');

        return view('admin.eventEnrolls.show', compact('eventEnroll'));
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
