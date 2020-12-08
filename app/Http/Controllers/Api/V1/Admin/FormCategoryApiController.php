<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormCategoryRequest;
use App\Http\Requests\UpdateFormCategoryRequest;
use App\Http\Resources\Admin\FormCategoryResource;
use App\Models\FormCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('form_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormCategoryResource(FormCategory::all());
    }

    public function store(StoreFormCategoryRequest $request)
    {
        $formCategory = FormCategory::create($request->all());

        return (new FormCategoryResource($formCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormCategoryResource($formCategory);
    }

    public function update(UpdateFormCategoryRequest $request, FormCategory $formCategory)
    {
        $formCategory->update($request->all());

        return (new FormCategoryResource($formCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FormCategory $formCategory)
    {
        abort_if(Gate::denies('form_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
