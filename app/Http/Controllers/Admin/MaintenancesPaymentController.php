<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaintenancesPaymentRequest;
use App\Http\Requests\StoreMaintenancesPaymentRequest;
use App\Http\Requests\UpdateMaintenancesPaymentRequest;
use App\Models\MaintenancesPayment;
use App\Models\PaymentMethod;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaintenancesPaymentController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('maintenances_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaintenancesPayment::with(['username', 'payment_method'])->select(sprintf('%s.*', (new MaintenancesPayment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'maintenances_payment_show';
                $editGate      = 'maintenances_payment_edit';
                $deleteGate    = 'maintenances_payment_delete';
                $crudRoutePart = 'maintenances-payments';

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
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('month', function ($row) {
                return $row->month ? $row->month : "";
            });
            $table->editColumn('receipt', function ($row) {
                return $row->receipt ? '<a href="' . $row->receipt->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? MaintenancesPayment::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('username_username', function ($row) {
                return $row->username ? $row->username->username : '';
            });

            $table->addColumn('payment_method_method', function ($row) {
                return $row->payment_method ? $row->payment_method->method : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'receipt', 'username', 'payment_method']);

            return $table->make(true);
        }

        return view('admin.maintenancesPayments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('maintenances_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.maintenancesPayments.create', compact('usernames', 'payment_methods'));
    }

    public function store(StoreMaintenancesPaymentRequest $request)
    {
        $maintenancesPayment = MaintenancesPayment::create($request->all());

        if ($request->input('receipt', false)) {
            $maintenancesPayment->addMedia(storage_path('tmp/uploads/' . $request->input('receipt')))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $maintenancesPayment->id]);
        }

        return redirect()->route('admin.maintenances-payments.index');
    }

    public function edit(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenancesPayment->load('username', 'payment_method');

        return view('admin.maintenancesPayments.edit', compact('usernames', 'payment_methods', 'maintenancesPayment'));
    }

    public function update(UpdateMaintenancesPaymentRequest $request, MaintenancesPayment $maintenancesPayment)
    {
        $maintenancesPayment->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$maintenancesPayment->receipt || $request->input('receipt') !== $maintenancesPayment->receipt->file_name) {
                if ($maintenancesPayment->receipt) {
                    $maintenancesPayment->receipt->delete();
                }

                $maintenancesPayment->addMedia(storage_path('tmp/uploads/' . $request->input('receipt')))->toMediaCollection('receipt');
            }
        } elseif ($maintenancesPayment->receipt) {
            $maintenancesPayment->receipt->delete();
        }

        return redirect()->route('admin.maintenances-payments.index');
    }

    public function show(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenancesPayment->load('username', 'payment_method');

        return view('admin.maintenancesPayments.show', compact('maintenancesPayment'));
    }

    public function destroy(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenancesPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenancesPaymentRequest $request)
    {
        MaintenancesPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('maintenances_payment_create') && Gate::denies('maintenances_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MaintenancesPayment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
