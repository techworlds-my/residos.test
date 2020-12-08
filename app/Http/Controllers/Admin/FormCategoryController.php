<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFormCategoryRequest;
use App\Http\Requests\StoreFormCategoryRequest;
use App\Http\Requests\UpdateFormCategoryRequest;
use App\Models\FormCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FormCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('form_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FormCategory::query()->select(sprintf('%s.*', (new FormCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'form_category_show';
                $editGate      = 'form_category_edit';
                $deleteGate    = 'form_category_delete';
                $crudRoutePart = 'form-categories';

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
            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : "";
            });
            $table->editColumn('in_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->in_enable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'in_enable']);

            return $table->make(true);
        }

        return view('admin.formCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('form_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formCategories.create');
    }

    public function store(StoreFormCategoryRequest $request)
    {
        $formCategory = FormCategory::create($request->all());

        return redirect()->route('admin.form-categories.index');
    }

    public function edit(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formCategories.edit', compact('formCategory'));
    }

    public function update(UpdateFormCategoryRequest $request, FormCategory $formCategory)
    {
        $formCategory->update($request->all());

        return redirect()->route('admin.form-categories.index');
    }

    public function show(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formCategories.show', compact('formCategory'));
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
