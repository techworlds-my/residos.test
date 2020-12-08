<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStatusControlRequest;
use App\Http\Requests\StoreStatusControlRequest;
use App\Http\Requests\UpdateStatusControlRequest;
use App\Models\StatusControl;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusControlController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('status_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusControls = StatusControl::all();

        return view('frontend.statusControls.index', compact('statusControls'));
    }

    public function create()
    {
        abort_if(Gate::denies('status_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusControls.create');
    }

    public function store(StoreStatusControlRequest $request)
    {
        $statusControl = StatusControl::create($request->all());

        return redirect()->route('frontend.status-controls.index');
    }

    public function edit(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusControls.edit', compact('statusControl'));
    }

    public function update(UpdateStatusControlRequest $request, StatusControl $statusControl)
    {
        $statusControl->update($request->all());

        return redirect()->route('frontend.status-controls.index');
    }

    public function show(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.statusControls.show', compact('statusControl'));
    }

    public function destroy(StatusControl $statusControl)
    {
        abort_if(Gate::denies('status_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusControl->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatusControlRequest $request)
    {
        StatusControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
