<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddTanentRequest;
use App\Http\Requests\StoreAddTanentRequest;
use App\Http\Requests\UpdateAddTanentRequest;
use App\Models\AddTanent;
use App\Models\AddUnit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTanentController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('add_tanent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanents = AddTanent::with(['unit', 'tanent'])->get();

        return view('frontend.addTanents.index', compact('addTanents'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_tanent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tanents = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addTanents.create', compact('units', 'tanents'));
    }

    public function store(StoreAddTanentRequest $request)
    {
        $addTanent = AddTanent::create($request->all());

        return redirect()->route('frontend.add-tanents.index');
    }

    public function edit(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = AddUnit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tanents = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addTanent->load('unit', 'tanent');

        return view('frontend.addTanents.edit', compact('units', 'tanents', 'addTanent'));
    }

    public function update(UpdateAddTanentRequest $request, AddTanent $addTanent)
    {
        $addTanent->update($request->all());

        return redirect()->route('frontend.add-tanents.index');
    }

    public function show(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanent->load('unit', 'tanent');

        return view('frontend.addTanents.show', compact('addTanent'));
    }

    public function destroy(AddTanent $addTanent)
    {
        abort_if(Gate::denies('add_tanent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTanent->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddTanentRequest $request)
    {
        AddTanent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
