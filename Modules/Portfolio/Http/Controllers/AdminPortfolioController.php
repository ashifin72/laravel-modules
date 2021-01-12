<?php

namespace Modules\Portfolio\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;

use Modules\Portfolio\Http\Requests\PorfolioRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MetaTag;
use Modules\Portfolio\Entities\Portfolio;
use Modules\Portfolio\Repositories\PortfolioCategoryRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;

class AdminPortfolioController extends AdminBaseController
{
    private $portfolioRepository, $portfolioCategoryRepository;
    public function __construct()
    {
        parent::__construct();
        $this->portfolioRepository = app(PortfolioRepository::class);
        $this->portfolioCategoryRepository = app(PortfolioCategoryRepository::class);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        MetaTag::setTags(['title'=> __('admin.portfolio')]);
        $colums = ['id', 'img', 'title_ru', 'title_uk', 'title_en', 'sort', 'status', 'portfolio_categories_id'];
        $items = $this->portfolioRepository->getAllWithPaginate(20, $colums);

        return view('portfolio::admin.portfolios.index',
            compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $item = Portfolio::make();
        $locales = $this->portfolioRepository->getActiveLocales();
        $categoryList = $this->portfolioCategoryRepository->getForComboBox();
        return view('portfolio::admin.portfolios.create',
            compact('item', 'locales', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PorfolioRequest $request)
    {
        $data = $request->input();

        $item = Portfolio::create($data);

        return $this->portfolioRepository
            ->resultRecording($item, 'admin.portfolios.edit', $item->id);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $item = $this->portfolioRepository->getEditId($id);
        if (empty($item)) {
            abort(404);
        }
        $locales = $this->portfolioRepository->getActiveLocales();
        $categoryList = $this->portfolioCategoryRepository->getForComboBox();
        return view('portfolio::admin.portfolios.edit',
            compact('item', 'locales', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PorfolioRequest $request, $id)
    {
        $item = $this->portfolioRepository->getEditId($id);
        $this->portfolioRepository->issetItem($id);
        $data = $request->input();
        $result = $item
            ->fill($data)
            ->save();
        return $this->portfolioRepository
            ->resultRecording($result, 'admin.portfolios.edit', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = Portfolio::destroy($id);

        if($result){
            return redirect()
                ->route('admin.portfolios.index')
                ->with(['success' => __('admin.article'). ' id  ' . $id . __('admin.delete')]);
        }else{
            return back()->withErrors(['msg'=> __('admin.error_delete')]);
        }
    }
}
