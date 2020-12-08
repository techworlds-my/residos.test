<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddBlockRequest;
use App\Http\Requests\StoreAddBlockRequest;
use App\Http\Requests\UpdateAddBlockRequest;
use App\Models\AddBlock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddBlockController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('add_block_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBlocks = AddBlock::all();

        return view('frontend.addBlocks.index', compact('addBlocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_block_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.addBlocks.create');
    }

    public function store(StoreAddBlockRequest $request)
    {
        $addBlock = AddBlock::create($request->all());

        return redirect()->route('frontend.add-blocks.index');
    }

    public function edit(AddBlock $addBlock)
    {
        abort_if(Gate::denies('add_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.addBlocks.edit', compact('addBlock'));
    }

    public function update(UpdateAddBlockRequest $request, AddBlock $addBlock)
    {
        $addBlock->update($request->all());

        return redirect()->route('frontend.add-blocks.index');
    }

    public function show(AddBlock $addBlock)
    {
        abort_if(Gate::denies('add_block_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.addBlocks.show', compact('addBlock'));
    }

    public function destroy(AddBlock $addBlock)
    {
        abort_if(Gate::denies('add_block_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBlock->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddBlockRequest $request)
    {
        AddBlock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
