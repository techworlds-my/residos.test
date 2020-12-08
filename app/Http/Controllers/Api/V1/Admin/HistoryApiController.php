<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;
use App\Http\Resources\Admin\HistoryResource;
use App\Models\History;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HistoryResource(History::with(['username', 'entrance'])->get());
    }

    public function store(StoreHistoryRequest $request)
    {
        $history = History::create($request->all());

        return (new HistoryResource($history))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(History $history)
    {
        abort_if(Gate::denies('history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HistoryResource($history->load(['username', 'entrance']));
    }

    public function update(UpdateHistoryRequest $request, History $history)
    {
        $history->update($request->all());

        return (new HistoryResource($history))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(History $history)
    {
        abort_if(Gate::denies('history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $history->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
