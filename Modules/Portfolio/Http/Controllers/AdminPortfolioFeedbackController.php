<?php

namespace Modules\Portfolio\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MetaTag;
use Modules\Portfolio\Entities\PortfolioFeedback;
use Modules\Portfolio\Http\Requests\FeedbackRequest;
use Modules\Portfolio\Repositories\FeedbackRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;

class AdminPortfolioFeedbackController extends AdminBaseController
{
  private $feedbackRepository, $portfolioRepository;

  public function __construct()
  {
    parent::__construct();
    $this->portfolioRepository = app(PortfolioRepository::class);
    $this->feedbackRepository = app(FeedbackRepository::class);
  }

  /**
     * Display a listing of the resource.
     * @return Renderable
     */
  public function index()
  {
    MetaTag::setTags(['title' => __('admin.feedback')]);
    $colums = ['id', 'img', 'title_ru', 'title_uk', 'title_en', 'sort', 'status', 'portfolio_id'];
    $items = $this->feedbackRepository->getAllWithPaginate(10, $colums);
    return view('portfolio::admin.portfolios.feedback.index', compact('items'));
  }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      $item=PortfolioFeedback::make();
      $locales = $this->portfolioRepository->getActiveLocales();
      $feedbackList = $this->portfolioRepository->getForComboBox();
      return view('portfolio::admin.portfolios.feedback.create',
        compact('item', 'locales', 'feedbackList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(FeedbackRequest $request)
    {
      $data = $request->input();

      $item = PortfolioFeedback::create($data);

      return $this->feedbackRepository
        ->resultRecording($item, 'admin.portfolio_feedback.edit', $item->id);
    }



    public function edit($id)
    {
      $item = $this->feedbackRepository->getEditId($id);
      if (empty($item)) {
        abort(404);
      }
      $feedbackList = $this->portfolioRepository->getForComboBox();
      $locales = $this->portfolioRepository->getActiveLocales();
      return view('portfolio::admin.portfolios.feedback.edit',
        compact('item', 'locales', 'feedbackList'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(FeedbackRequest $request, $id)
    {
      $item = $this->feedbackRepository->getEditId($id);

      $this->feedbackRepository->issetItem($id);
      $data = $request->input();
      $result = $item
        ->fill($data)
        ->save();
      return $this->feedbackRepository
        ->resultRecording($result, 'admin.portfolio_feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
      $result = PortfolioFeedback::destroy($id);

      if($result){
        return redirect()
          ->route('admin.portfolio_feedback.index')
          ->with(['success' => __('admin.article'). ' id ' . $id . __('admin.delete')]);
      }else{
        return back()->withErrors(['msg'=> __('admin.error_delete')]);
      }
    }
}
