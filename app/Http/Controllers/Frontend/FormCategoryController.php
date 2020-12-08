<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFormCategoryRequest;
use App\Http\Requests\StoreFormCategoryRequest;
use App\Http\Requests\UpdateFormCategoryRequest;
use App\Models\FormCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('form_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formCategories = FormCategory::all();

        return view('frontend.formCategories.index', compact('formCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('form_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.formCategories.create');
    }

    public function store(StoreFormCategoryRequest $request)
    {
        $formCategory = FormCategory::create($request->all());

        return redirect()->route('frontend.form-categories.index');
    }

    public function edit(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.formCategories.edit', compact('formCategory'));
    }

    public function update(UpdateFormCategoryRequest $request, FormCategory $formCategory)
    {
        $formCategory->update($request->all());

        return redirect()->route('frontend.form-categories.index');
    }

    public function show(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.formCategories.show', compact('formCategory'));
    }

    public function destroy(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormCategoryRequest $request)
    {
        FormCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
