<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFacilityCategoryRequest;
use App\Http\Requests\StoreFacilityCategoryRequest;
use App\Http\Requests\UpdateFacilityCategoryRequest;
use App\Models\FacilityCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityCategoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('facility_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityCategories = FacilityCategory::all();

        return view('frontend.facilityCategories.index', compact('facilityCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('facility_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.facilityCategories.create');
    }

    public function store(StoreFacilityCategoryRequest $request)
    {
        $facilityCategory = FacilityCategory::create($request->all());

        return redirect()->route('frontend.facility-categories.index');
    }

    public function edit(FacilityCategory $facilityCategory)
    {
        abort_if(Gate::denies('facility_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.facilityCategories.edit', compact('facilityCategory'));
    }

    public function update(UpdateFacilityCategoryRequest $request, FacilityCategory $facilityCategory)
    {
        $facilityCategory->update($request->all());

        return redirect()->route('frontend.facility-categories.index');
    }

    public function show(FacilityCategory $facilityCategory)
    {
        abort_if(Gate::denies('facility_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.facilityCategories.show', compact('facilityCategory'));
    }

    public function destroy(FacilityCategory $facilityCategory)
    {
        abort_if(Gate::denies('facility_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacilityCategoryRequest $request)
    {
        FacilityCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
