<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDefactCategoryRequest;
use App\Http\Requests\StoreDefactCategoryRequest;
use App\Http\Requests\UpdateDefactCategoryRequest;
use App\Models\DefactCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DefactCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('defact_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DefactCategory::query()->select(sprintf('%s.*', (new DefactCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'defact_category_show';
                $editGate      = 'defact_category_edit';
                $deleteGate    = 'defact_category_delete';
                $crudRoutePart = 'defact-categories';

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
            $table->editColumn('defact_category', function ($row) {
                return $row->defact_category ? $row->defact_category : "";
            });
            $table->editColumn('in_enable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->in_enable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'in_enable']);

            return $table->make(true);
        }

        return view('admin.defactCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('defact_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.defactCategories.create');
    }

    public function store(StoreDefactCategoryRequest $request)
    {
        $defactCategory = DefactCategory::create($request->all());

        return redirect()->route('admin.defact-categories.index');
    }

    public function edit(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.defactCategories.edit', compact('defactCategory'));
    }

    public function update(UpdateDefactCategoryRequest $request, DefactCategory $defactCategory)
    {
        $defactCategory->update($request->all());

        return redirect()->route('admin.defact-categories.index');
    }

    public function show(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.defactCategories.show', compact('defactCategory'));
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
