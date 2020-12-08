<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntranceRequest;
use App\Http\Requests\StoreEntranceRequest;
use App\Http\Requests\UpdateEntranceRequest;
use App\Models\Entrance;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntranceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entrance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrances = Entrance::with(['location'])->get();

        return view('frontend.entrances.index', compact('entrances'));
    }

    public function create()
    {
        abort_if(Gate::denies('entrance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.entrances.create', compact('locations'));
    }

    public function store(StoreEntranceRequest $request)
    {
        $entrance = Entrance::create($request->all());

        return redirect()->route('frontend.entrances.index');
    }

    public function edit(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entrance->load('location');

        return view('frontend.entrances.edit', compact('locations', 'entrance'));
    }

    public function update(UpdateEntranceRequest $request, Entrance $entrance)
    {
        $entrance->update($request->all());

        return redirect()->route('frontend.entrances.index');
    }

    public function show(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrance->load('location');

        return view('frontend.entrances.show', compact('entrance'));
    }

    public function destroy(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrance->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntranceRequest $request)
    {
        Entrance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
