<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeedbackCategoryRequest;
use App\Http\Requests\StoreFeedbackCategoryRequest;
use App\Http\Requests\UpdateFeedbackCategoryRequest;
use App\Models\FeedbackCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('feedback_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackCategories = FeedbackCategory::all();

        return view('frontend.feedbackCategories.index', compact('feedbackCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('feedback_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.feedbackCategories.create');
    }

    public function store(StoreFeedbackCategoryRequest $request)
    {
        $feedbackCategory = FeedbackCategory::create($request->all());

        return redirect()->route('frontend.feedback-categories.index');
    }

    public function edit(FeedbackCategory $feedbackCategory)
    {
        abort_if(Gate::denies('feedback_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.feedbackCategories.edit', compact('feedbackCategory'));
    }

    public function update(UpdateFeedbackCategoryRequest $request, FeedbackCategory $feedbackCategory)
    {
        $feedbackCategory->update($request->all());

        return redirect()->route('frontend.feedback-categories.index');
    }

    public function show(FeedbackCategory $feedbackCategory)
    {
        abort_if(Gate::denies('feedback_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.feedbackCategories.show', compact('feedbackCategory'));
    }

    public function destroy(FeedbackCategory $feedbackCategory)
    {
        abort_if(Gate::denies('feedback_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedbackCategoryRequest $request)
    {
        FeedbackCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
