<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddVisitorRequest;
use App\Http\Requests\StoreAddVisitorRequest;
use App\Http\Requests\UpdateAddVisitorRequest;
use App\Models\AddVisitor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddVisitorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_visitor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitors = AddVisitor::with(['username', 'add_by'])->get();

        return view('frontend.addVisitors.index', compact('addVisitors'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_visitor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $add_bies = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addVisitors.create', compact('usernames', 'add_bies'));
    }

    public function store(StoreAddVisitorRequest $request)
    {
        $addVisitor = AddVisitor::create($request->all());

        return redirect()->route('frontend.add-visitors.index');
    }

    public function edit(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $add_bies = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addVisitor->load('username', 'add_by');

        return view('frontend.addVisitors.edit', compact('usernames', 'add_bies', 'addVisitor'));
    }

    public function update(UpdateAddVisitorRequest $request, AddVisitor $addVisitor)
    {
        $addVisitor->update($request->all());

        return redirect()->route('frontend.add-visitors.index');
    }

    public function show(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitor->load('username', 'add_by');

        return view('frontend.addVisitors.show', compact('addVisitor'));
    }

    public function destroy(AddVisitor $addVisitor)
    {
        abort_if(Gate::denies('add_visitor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addVisitor->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddVisitorRequest $request)
    {
        AddVisitor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
