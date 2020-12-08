<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQrRequest;
use App\Http\Requests\StoreQrRequest;
use App\Http\Requests\UpdateQrRequest;
use App\Models\Qr;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QrController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrs = Qr::with(['username'])->get();

        return view('frontend.qrs.index', compact('qrs'));
    }

    public function create()
    {
        abort_if(Gate::denies('qr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.qrs.create', compact('usernames'));
    }

    public function store(StoreQrRequest $request)
    {
        $qr = Qr::create($request->all());

        return redirect()->route('frontend.qrs.index');
    }

    public function edit(Qr $qr)
    {
        abort_if(Gate::denies('qr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr->load('username');

        return view('frontend.qrs.edit', compact('usernames', 'qr'));
    }

    public function update(UpdateQrRequest $request, Qr $qr)
    {
        $qr->update($request->all());

        return redirect()->route('frontend.qrs.index');
    }

    public function show(Qr $qr)
    {
        abort_if(Gate::denies('qr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr->load('username');

        return view('frontend.qrs.show', compact('qr'));
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
