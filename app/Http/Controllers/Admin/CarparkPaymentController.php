<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarparkPaymentRequest;
use App\Http\Requests\StoreCarparkPaymentRequest;
use App\Http\Requests\UpdateCarparkPaymentRequest;
use App\Models\CarparkLocation;
use App\Models\CarparkPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarparkPaymentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('carpark_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CarparkPayment::with(['location'])->select(sprintf('%s.*', (new CarparkPayment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'carpark_payment_show';
                $editGate      = 'carpark_payment_edit';
                $deleteGate    = 'carpark_payment_delete';
                $crudRoutePart = 'carpark-payments';

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
            $table->editColumn('carplate', function ($row) {
                return $row->carplate ? $row->carplate : "";
            });
            $table->editColumn('payment', function ($row) {
                return $row->payment ? $row->payment : "";
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? $row->payment_method : "";
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->addColumn('location_location', function ($row) {
                return $row->location ? $row->location->location : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'location']);

            return $table->make(true);
        }

        return view('admin.carparkPayments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('carpark_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carparkPayments.create', compact('locations'));
    }

    public function store(StoreCarparkPaymentRequest $request)
    {
        $carparkPayment = CarparkPayment::create($request->all());

        return redirect()->route('admin.carpark-payments.index');
    }

    public function edit(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = CarparkLocation::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carparkPayment->load('location');

        return view('admin.carparkPayments.edit', compact('locations', 'carparkPayment'));
    }

    public function update(UpdateCarparkPaymentRequest $request, CarparkPayment $carparkPayment)
    {
        $carparkPayment->update($request->all());

        return redirect()->route('admin.carpark-payments.index');
    }

    public function show(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayment->load('location');

        return view('admin.carparkPayments.show', compact('carparkPayment'));
    }

    public function destroy(CarparkPayment $carparkPayment)
    {
        abort_if(Gate::denies('carpark_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carparkPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarparkPaymentRequest $request)
    {
        CarparkPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
