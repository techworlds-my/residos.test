<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddUnitRequest;
use App\Http\Requests\StoreAddUnitRequest;
use App\Http\Requests\UpdateAddUnitRequest;
use App\Models\AddBlock;
use App\Models\AddUnit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddUnitController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('add_unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnits = AddUnit::with(['block'])->get();

        return view('frontend.addUnits.index', compact('addUnits'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = AddBlock::all()->pluck('block', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addUnits.create', compact('blocks'));
    }

    public function store(StoreAddUnitRequest $request)
    {
        $addUnit = AddUnit::create($request->all());

        return redirect()->route('frontend.add-units.index');
    }

    public function edit(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = AddBlock::all()->pluck('block', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addUnit->load('block');

        return view('frontend.addUnits.edit', compact('blocks', 'addUnit'));
    }

    public function update(UpdateAddUnitRequest $request, AddUnit $addUnit)
    {
        $addUnit->update($request->all());

        return redirect()->route('frontend.add-units.index');
    }

    public function show(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnit->load('block');

        return view('frontend.addUnits.show', compact('addUnit'));
    }

    public function destroy(AddUnit $addUnit)
    {
        abort_if(Gate::denies('add_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addUnit->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddUnitRequest $request)
    {
        AddUnit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
