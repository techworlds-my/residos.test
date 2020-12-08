<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQrRequest;
use App\Http\Requests\StoreQrRequest;
use App\Http\Requests\UpdateQrRequest;
use App\Models\Qr;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QrController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('qr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Qr::with(['username'])->select(sprintf('%s.*', (new Qr)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'qr_show';
                $editGate      = 'qr_edit';
                $deleteGate    = 'qr_delete';
                $crudRoutePart = 'qrs';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'username']);

            return $table->make(true);
        }

        return view('admin.qrs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('qr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.qrs.create', compact('usernames'));
    }

    public function store(StoreQrRequest $request)
    {
        $qr = Qr::create($request->all());

        return redirect()->route('admin.qrs.index');
    }

    public function edit(Qr $qr)
    {
        abort_if(Gate::denies('qr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr->load('username');

        return view('admin.qrs.edit', compact('usernames', 'qr'));
    }

    public function update(UpdateQrRequest $request, Qr $qr)
    {
        $qr->update($request->all());

        return redirect()->route('admin.qrs.index');
    }

    public function show(Qr $qr)
    {
        abort_if(Gate::denies('qr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr->load('username');

        return view('admin.qrs.show', compact('qr'));
    }

    public function destroy(Qr $qr)
    {
        abort_if(Gate::denies('qr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr->delete();

        return back();
    }

    public function massDestroy(MassDestroyQrRequest $request)
    {
        Qr::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
