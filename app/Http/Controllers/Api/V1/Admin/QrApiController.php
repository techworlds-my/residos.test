<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQrRequest;
use App\Http\Requests\UpdateQrRequest;
use App\Http\Resources\Admin\QrResource;
use App\Models\Qr;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QrApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QrResource(Qr::with(['username'])->get());
    }

    public function store(StoreQrRequest $request)
    {
        $qr = Qr::create($request->all());

        return (new QrResource($qr))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Qr $qr)
    {
        abort_if(Gate::denies('qr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QrResource($qr->load(['username']));
    }

    public function update(UpdateQrRequest $request, Qr $qr)
    {
        $qr->update($request->all());

        return (new QrResource($qr))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Qr $qr)
    {
        abort_if(Gate::denies('qr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
