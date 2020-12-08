<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FacilityBookController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('facility_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FacilityBook::with(['facility', 'user'])->select(sprintf('%s.*', (new FacilityBook)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'facility_book_show';
                $editGate      = 'facility_book_edit';
                $deleteGate    = 'facility_book_delete';
                $crudRoutePart = 'facility-books';

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

            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : "";
            });
            $table->addColumn('facility_name', function ($row) {
                return $row->facility ? $row->facility->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'facility', 'user']);

            return $table->make(true);
        }

        return view('admin.facilityBooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('facility_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.facilityBooks.create', compact('facilities', 'users'));
    }

    public function store(StoreFacilityBookRequest $request)
    {
        $facilityBook = FacilityBook::create($request->all());

        return redirect()->route('admin.facility-books.index');
    }

    public function edit(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = FacilityManagement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilityBook->load('facility', 'user');

        return view('admin.facilityBooks.edit', compact('facilities', 'users', 'facilityBook'));
    }

    public function update(UpdateFacilityBookRequest $request, FacilityBook $facilityBook)
    {
        $facilityBook->update($request->all());

        return redirect()->route('admin.facility-books.index');
    }

    public function show(FacilityBook $facilityBook)
    {
        abort_if(Gate::denies('facility_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilityBook->load('facility', 'user');

        return view('admin.facilityBooks.show', compact('facilityBook'));
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
