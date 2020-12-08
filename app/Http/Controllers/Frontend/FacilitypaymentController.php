<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFacilitypaymentRequest;
use App\Http\Requests\StoreFacilitypaymentRequest;
use App\Http\Requests\UpdateFacilitypaymentRequest;
use App\Models\Facilitypayment;
use App\Models\PaymentMethod;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FacilitypaymentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('facilitypayment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilitypayments = Facilitypayment::with(['username', 'payment_method', 'media'])->get();

        return view('frontend.facilitypayments.index', compact('facilitypayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('facilitypayment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.facilitypayments.create', compact('usernames', 'payment_methods'));
    }

    public function store(StoreFacilitypaymentRequest $request)
    {
        $facilitypayment = Facilitypayment::create($request->all());

        if ($request->input('reciept', false)) {
            $facilitypayment->addMedia(storage_path('tmp/uploads/' . $request->input('reciept')))->toMediaCollection('reciept');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $facilitypayment->id]);
        }

        return redirect()->route('frontend.facilitypayments.index');
    }

    public function edit(Facilitypayment $facilitypayment)
    {
        abort_if(Gate::denies('facilitypayment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usernames = User::all()->pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::all()->pluck('method', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilitypayment->load('username', 'payment_method');

        return view('frontend.facilitypayments.edit', compact('usernames', 'payment_methods', 'facilitypayment'));
    }

    public function update(UpdateFacilitypaymentRequest $request, Facilitypayment $facilitypayment)
    {
        $facilitypayment->update($request->all());

        if ($request->input('reciept', false)) {
            if (!$facilitypayment->reciept || $request->input('reciept') !== $facilitypayment->reciept->file_name) {
                if ($facilitypayment->reciept) {
                    $facilitypayment->reciept->delete();
                }

                $facilitypayment->addMedia(storage_path('tmp/uploads/' . $request->input('reciept')))->toMediaCollection('reciept');
            }
        } elseif ($facilitypayment->reciept) {
            $facilitypayment->reciept->delete();
        }

        return redirect()->route('frontend.facilitypayments.index');
    }

    public function show(Facilitypayment $facilitypayment)
    {
        abort_if(Gate::denies('facilitypayment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilitypayment->load('username', 'payment_method');

        return view('frontend.facilitypayments.show', compact('facilitypayment'));
    }

    public function destroy(Facilitypayment $facilitypayment)
    {
        abort_if(Gate::denies('facilitypayment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilitypayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacilitypaymentRequest $request)
    {
        Facilitypayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('facilitypayment_create') && Gate::denies('facilitypayment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Facilitypayment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
