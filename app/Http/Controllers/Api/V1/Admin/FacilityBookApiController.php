<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityBookRequest;
use App\Http\Requests\UpdateFacilityBookRequest;
use App\Http\Resources\Admin\FacilityBookResource;
use App\Models\FacilityBook;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityBookApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facility_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityBookResource(FacilityBook::with(['facility', 'user'])->get());
    }

    public function store(StoreFacilityBookRequest $request)
    {
        $facilityBook = FacilityBook::create($request->all());

        return (new FacilityBookResource($facilityBook))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityBookResource($facilityBook->load(['facility', 'user']));
    }

    public function update(UpdateFacilityBookRequest $request, FacilityBook $facilityBook)
    {
        $facilityBook->update($request->all());

        return (new FacilityBookResource($facilityBook))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityBook->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
