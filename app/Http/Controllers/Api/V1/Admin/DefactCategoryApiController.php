<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDefactCategoryRequest;
use App\Http\Requests\UpdateDefactCategoryRequest;
use App\Http\Resources\Admin\DefactCategoryResource;
use App\Models\DefactCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefactCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('defact_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DefactCategoryResource(DefactCategory::all());
    }

    public function store(StoreDefactCategoryRequest $request)
    {
        $defactCategory = DefactCategory::create($request->all());

        return (new DefactCategoryResource($defactCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DefactCategoryResource($defactCategory);
    }

    public function update(UpdateDefactCategoryRequest $request, DefactCategory $defactCategory)
    {
        $defactCategory->update($request->all());

        return (new DefactCategoryResource($defactCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DefactCategory $defactCategory)
    {
        abort_if(Gate::denies('defact_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $defactCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
