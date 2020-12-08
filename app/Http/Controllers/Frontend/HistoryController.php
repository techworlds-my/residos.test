<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHistoryRequest;
use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;
use App\Models\Entrance;
use App\Models\History;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $histories = History::with(['username', 'entrance'])->get();

        return view('frontend.histories.index', compact('histories'));
    }

    public function create()
    {
        abort_if(Gate::denies('history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entrances = Entrance::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.histories.create', compact('usernames', 'entrances'));
    }

    public function store(StoreHistoryRequest $request)
    {
        $history = History::create($request->all());

        return redirect()->route('frontend.histories.index');
    }

    public function edit(History $history)
    {
        abort_if(Gate::denies('history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entrances = Entrance::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $history->load('username', 'entrance');

        return view('frontend.histories.edit', compact('usernames', 'entrances', 'history'));
    }

    public function update(UpdateHistoryRequest $request, History $history)
    {
        $history->update($request->all());

        return redirect()->route('frontend.histories.index');
    }

    public function show(History $history)
    {
        abort_if(Gate::denies('history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $history->load('username', 'entrance');

        return view('frontend.histories.show', compact('history'));
    }

    public function destroy(History $history)
    {
        abort_if(Gate::denies('history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $history->delete();

        return back();
    }

    public function massDestroy(MassDestroyHistoryRequest $request)
    {
        History::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
