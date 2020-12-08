<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDefactCategoryRequest;
use App\Http\Requests\StoreDefactCategoryRequest;
use App\Http\Requests\UpdateDefactCategoryRequest;
use App\Models\DefactCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefactCategoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('defact_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $defactCategories = DefactCategory::all();

        return view('frontend.defactCategories.index', compact('defactCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('defact_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.defactCategories.create');
    }

    public function store(StoreDefactCategoryRequest $request)
    {
        $defactCategory = DefactCategory::create($request->all());

        return redirect()->route('frontend.defact-categories.index');
    }

    public function edit(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.defactCategories.edit', compact('defactCategory'));
    }

    public function update(UpdateDefactCategoryRequest $request, DefactCategory $defactCategory)
    {
        $defactCategory->update($request->all());

        return redirect()->route('frontend.defact-categories.index');
    }

    public function show(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.defactCategories.show', compact('defactCategory'));
    }

    public function destroy(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $defactCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyDefactCategoryRequest $request)
    {
        DefactCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
