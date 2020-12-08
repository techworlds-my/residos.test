<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFacilityBookRequest;
use App\Http\Requests\StoreFacilityBookRequest;
use App\Http\Requests\UpdateFacilityBookRequest;
use App\Models\FacilityBook;
use App\Models\FacilityManagement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityBookController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facility_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityBooks = FacilityBook::with(['facility', 'user'])->get();

        return view('frontend.facilityBooks.index', compact('facilityBooks'));
    }

    public function create()
    {
        abort_if(Gate::denies('facility_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.facilityBooks.create', compact('facilities', 'users'));
    }

    public function store(StoreFacilityBookRequest $request)
    {
        $facilityBook = FacilityBook::create($request->all());

        return redirect()->route('frontend.facility-books.index');
    }

    public function edit(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilityBook->load('facility', 'user');

        return view('frontend.facilityBooks.edit', compact('facilities', 'users', 'facilityBook'));
    }

    public function update(UpdateFacilityBookRequest $request, FacilityBook $facilityBook)
    {
        $facilityBook->update($request->all());

        return redirect()->route('frontend.facility-books.index');
    }

    public function show(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityBook->load('facility', 'user');

        return view('frontend.facilityBooks.show', compact('facilityBook'));
    }

    public function destroy(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityBook->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacilityBookRequest $request)
    {
        FacilityBook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
