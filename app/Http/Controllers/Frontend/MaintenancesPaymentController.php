<?php

namespace App\Http\Controllers\Frontend;

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

class MaintenancesPaymentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenances_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenancesPayments = MaintenancesPayment::with(['username', 'payment_method', 'media'])->get();

        return view('frontend.maintenancesPayments.index', compact('maintenancesPayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintenances_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.maintenancesPayments.create', compact('usernames', 'payment_methods'));
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

        return redirect()->route('frontend.maintenances-payments.index');
    }

    public function edit(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenancesPayment->load('username', 'payment_method');

        return view('frontend.maintenancesPayments.edit', compact('usernames', 'payment_methods', 'maintenancesPayment'));
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

        return redirect()->route('frontend.maintenances-payments.index');
    }

    public function show(MaintenancesPayment $maintenancesPayment)
    {
        abort_if(Gate::denies('maintenances_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenancesPayment->load('username', 'payment_method');

        return view('frontend.maintenancesPayments.show', compact('maintenancesPayment'));
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
