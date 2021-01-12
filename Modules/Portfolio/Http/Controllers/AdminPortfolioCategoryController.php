<?php

namespace Modules\Portfolio\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Admin\Filter;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use MetaTag;
use Modules\Portfolio\Entities\Portfolio;
use Modules\Portfolio\Entities\PortfolioCategory;
use Modules\Portfolio\Http\Requests\PortfolioCategoryGreateRequest;
use Modules\Portfolio\Http\Requests\PortfolioCategoryUpdateRequest;
use Modules\Portfolio\Repositories\PortfolioCategoryRepository;


class AdminPortfolioCategoryController extends AdminBaseController
{
    private $localRepository, $portfolioCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->localRepository = app(LocalRepository::class);
        $this->portfolioCategoryRepository = app(PortfolioCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        MetaTag::setTags(['title' => __('admin.portfolio_filter')]);

        $colums = ['id', 'img', 'title_ru', 'title_uk', 'title_en', 'sort', 'status'];
        $items = $this->portfolioCategoryRepository->getAllWithPaginate(20, $colums);

        return view('portfolio::admin.portfolios.categories.index',
            compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $item = PortfolioCategory::make();
        $locales = $this->localRepository->getActiveLocales();
        return view('portfolio::admin.portfolios.categories.create', compact('item', 'locales'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PortfolioCategoryGreateRequest $request)
    {

        $data = $request->input();

        $item = PortfolioCategory::create($data);
        // выводим информацию о записи и перенаправляем на нужный роут
        return $this->portfolioCategoryRepository
            ->resultRecording($item, 'admin.portfolio_categories.edit', $item->id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $item = $this->portfolioCategoryRepository->getEditId($id);
        if (empty($item)) {
            abort(404);
        }
        $this->portfolioCategoryRepository->issetItem($item);
        $locales = $this->localRepository->getActiveLocales();
        return view('portfolio::admin.portfolios.categories.edit',
            compact('item', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PortfolioCategoryUpdateRequest $request, $id)
    {
        $item = $this->portfolioCategoryRepository->getEditId($id);
        $this->portfolioCategoryRepository->issetItem($id);
        $data = $request->input();
        $result = $item
            ->fill($data)
            ->save();
        return $this->portfolioCategoryRepository
            ->resultRecording($result, 'admin.portfolio_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
       $portfolios = Portfolio::where('portfolio_categories_id', '=', $id )->get();
       if (count($portfolios)){
           return back()->withErrors(['msg'=> __('admin.error_isset_date')]);
       }
        $result = PortfolioCategory::destroy($id);
        if($result){
            return redirect()
                ->route('admin.portfolio_categories.index')
                ->with(['success' => __('admin.article'). ' id ' . $id . __('admin.delete')]);
        }else{
            return back()->withErrors(['msg'=> __('admin.error_delete')]);
        }
    }
}
