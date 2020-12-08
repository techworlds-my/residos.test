<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntranceRequest;
use App\Http\Requests\StoreEntranceRequest;
use App\Http\Requests\UpdateEntranceRequest;
use App\Models\Entrance;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntranceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entrance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Entrance::with(['location'])->select(sprintf('%s.*', (new Entrance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entrance_show';
                $editGate      = 'entrance_edit';
                $deleteGate    = 'entrance_delete';
                $crudRoutePart = 'entrances';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('last_active', function ($row) {
                return $row->last_active ? $row->last_active : "";
            });
            $table->editColumn('in_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->in_enable ? 'checked' : null) . '>';
            });
            $table->addColumn('location_location', function ($row) {
                return $row->location ? $row->location->location : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'in_enable', 'location']);

            return $table->make(true);
        }

        return view('admin.entrances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entrance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entrances.create', compact('locations'));
    }

    public function store(StoreEntranceRequest $request)
    {
        $entrance = Entrance::create($request->all());

        return redirect()->route('admin.entrances.index');
    }

    public function edit(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entrance->load('location');

        return view('admin.entrances.edit', compact('locations', 'entrance'));
    }

    public function update(UpdateEntranceRequest $request, Entrance $entrance)
    {
        $entrance->update($request->all());

        return redirect()->route('admin.entrances.index');
    }

    public function show(Entrance $entrance)
    {
        abort_if(Gate::denies('entrance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrance->load('location');

        return view('admin.entrances.show', compact('entrance'));
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
